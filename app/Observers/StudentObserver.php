<?php

namespace App\Observers;

use App\Models\Intern;
use App\Models\Student;

class StudentObserver
{
    public function updated(Student $student)
    {
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
} 