<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    protected $fillable = [
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'year_level',
        'roster_number',
        'documents',
        'status',
        'guardian',
        'guardian_contact'
    ];

    protected $casts = [];
} 