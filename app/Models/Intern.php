<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    protected $fillable = [
        'student_number',
        'first_name',
        'last_name',
        'middle_name',
        'year_level',
        'status',
        'roster_number',
        'documents',
        'cibat_class',
        'batch_name',
    ];

    protected $casts = [
        'documents' => 'array'
    ];
} 