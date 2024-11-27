<?php

namespace App\Listeners;
use App\Models\DerogatoryRecord;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\StudentUpdated; 
class UpdateRelatedModules
{
    public function handle(StudentUpdated $event)
    {
        $student = $event->student;

        // Update or create the record in your module
        DerogatoryRecord::updateOrCreate(
            ['student_id_number' => $student->student_id_number],
            [
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'middle_name' => $student->middle_name,
                'year_level' => $student->year_level,
                'enrollment_status' => $student->enrollment_status,
                'graduation_date' => $student->graduation_date,
                'school_year' => $student->school_year,
            ]
        );
    }
}