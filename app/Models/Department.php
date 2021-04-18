<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'code',
        'description',
        'image',     
    ];

    public function scopeSearch($query, $search)
    {   
        return $query->where('name', 'LIKE', "%$search%")
                ->orWhere('code', 'LIKE', "%$search%");
    }   
}
