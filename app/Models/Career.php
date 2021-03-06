<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Career extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'department_id',
        'description',
        'educational_requirements',
        'no_of_vacancy',
        'employment_status',
        'location',
        'salary',
        'status',     
    ];

    public function department () {
        return $this->belongsTo(Department::class, 'department_id')->withTrashed();
    }

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeSearch($query, $search)
    {   
        // return $query->join('department')->where('title', 'LIKE', "%$  %")
        //         ->orWhere('description', 'LIKE', "%$search%");

        return $query->where('title', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%");

    }
    
}
