<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'salary',
        'city',
        'contact',
        'email',       
        'gender',       
    ];
}
