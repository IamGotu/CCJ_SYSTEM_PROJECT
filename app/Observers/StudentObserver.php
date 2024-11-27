<?php

namespace App\Observers;

use App\Models\Intern;
use App\Models\OjtRecord;
use App\Models\Student;

class StudentObserver
{
    public function updated(Student $student)
    {

        $this->createOrUpdateOjtRecord($student);

        // If the student is or was a 4th year student
        if ($student->year_level === 'GRADUATE' || $student->getOriginal('year_level') === '4TH') {
            Intern::updateOrCreate(
                ['student_number' => $student->student_number],
                [
                    'year_level' => $student->year_level,
                    'first_name' => $student->first_name,
                    'last_name' => $student->last_name,
                    // ... other fields ...
                ]
            );
        }

    }

    public function created(Student $student)
    {
        $this->createOrUpdateOjtRecord($student);
    }

    /**
     * Create or update the OjtRecord for the given student.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    protected function createOrUpdateOjtRecord(Student $student)
    {
        // Check if the student is a 4th-year student
        if ($student->year_level === '4TH') {
            // Check if an OjtRecord already exists for this student
            OjtRecord::updateOrCreate(
                ['student_number' => $student->student_id_number],  // Ensure this field exists in both tables
                [
                    'name' => $student->first_name . ' ' . $student->last_name,  // Full name
                    'student_number' => $student->student_id_number,  // Student number
                    'agency_assigned' => '', // Placeholder or custom logic here
                    'roster_number' => null, // Optional
                    'school_year' => $student->school_year,
                    'year_level' => $student->year_level,
                    'credit_hours' => 0, // You can set this to any other value as needed
                ]
            );  
        } else {
            // If the student's year_level is not 4th year, delete the OjtRecord
            OjtRecord::where('student_number', $student->student_id_number)->delete();
        }
    } 
}    