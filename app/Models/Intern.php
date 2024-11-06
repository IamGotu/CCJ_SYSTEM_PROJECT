<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    protected $fillable = [
        'student_number',
        'last_name',
        'first_name',
        'middle_name',
        'age',
        'address',
        'guardian',
        'guardian_contact',
        'roster_number',
        'documents'
    ];

    protected $casts = [
        'documents' => 'array'
    ];
} 