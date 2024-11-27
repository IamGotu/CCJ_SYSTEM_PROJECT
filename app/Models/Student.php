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
        'enrollment_status',
        'school_year',
        'year_level',
        'graduation_date',
    ];

    protected $casts = [
        'birthdate' => 'date',  // Cast birthdate to Carbon
        'graduation_date' => 'date',  // Cast graduation_date to Carbon
    ];

    protected static function booted()
    {
        // When a student is created or updated
        static::saved(function ($student) {
            // Check if student is 3RD or 4TH year
            if (in_array($student->year_level, ['3RD', '4TH'])) {
                // Add debugging
                \Log::info('Adding/Updating intern:', [
                    'student_id' => $student->student_id_number,
                    'year_level' => $student->year_level,
                    'name' => $student->first_name . ' ' . $student->last_name
                ]);

                Intern::updateOrCreate(
                    ['student_number' => $student->student_id_number],
                    [
                        'first_name' => explode(' ', $student->first_name)[0], // Get first name
                        'middle_name' => $student->middle_name,
                        'last_name' => explode(' ', $student->last_name)[0], // Get last name
                        'year_level' => $student->year_level,
                        'roster_number' => $student->student_id_number,
                        'guardian' => $student->guardian_name ?? 'Not Specified',
                        'guardian_contact' => $student->guardian_contact ?? 'Not Specified',
                        'status' => 'active'
                    ]
                );
            } else {
                // If student is no longer 3RD or 4TH year, remove from interns table
                Intern::where('student_number', $student->student_id_number)->delete();
            }
        });
        
    }
    public function derogatoryRecords()
    {
        return $this->hasMany(DerogatoryRecord::class, 'student_id_number', 'student_id_number');
    }
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'student_id_number', 'student_id_number');
    }

    public function ojtRecord()
    {
        return $this->hasOne(OjtRecord::class, 'student_number', 'student_id_number');
    }

}