<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function applicant () {
        return $this->belongsTo(Applicant::class, 'applicant_id')->withTrashed();
    }
    protected $fillable = [
        'salary',
        'contact',
        'email',
        'gender',
        'applicant_id',
        'employee_no',       
        'status',       
        'birthday',       
        'birthplace',       
        'present_address',       
        'provicial_address',       
        'living_arrangement',       
        'first_name',       
        'middle_name',       
        'last_name',       
        'nick_name',       
        'civil_status',       
        'nationality',       
        'blood_type',       
        'hire_date',       
        'formal_picture',       
    ];
}
