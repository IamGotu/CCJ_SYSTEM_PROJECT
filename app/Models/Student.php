<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id_number',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birthdate',
        'purok',
        'street_num',
        'street_name',
        'barangay',
        'city',
        'state',
        'postal_num',
        'contact_number',
        'father_name',
        'mother_name',
        'guardian_name',
        'father_contact',
        'mother_contact',
        'guardian_contact',
        'school_year',
        'year_level',
        'graduation_date',
    ];

    protected $casts = [
        'birthdate' => 'date',  // Cast birthdate to Carbon
        'graduation_date' => 'date',  // Cast graduation_date to Carbon
    ];
}