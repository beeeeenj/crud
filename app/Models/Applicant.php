<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Applicant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'career_id',
        'ref_no',
        'first_name',
        'middle_name',     
        'last_name',     
        'gender',     
        'email',     
        'contact',     
        'referred_by',     
        'file',     
        'status',     
        'note',     
        'is_hired',     
    ];

    public function career () {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function getFullNameAttribute(){
        if($this->middle_name) {
            return $this->first_name . ' ' . $this->last_name;
        }else{
            return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
        }
        
    }
}
