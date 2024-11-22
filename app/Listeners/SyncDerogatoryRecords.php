<?php

namespace App\Listeners;
use App\Models\DerogatoryRecord;
use App\Events\StudentImported;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncDerogatoryRecords
{
    /**
     * Handle the event.
     *
     * @param  StudentImported  $event
     * @return void
     */
    public function handle(StudentImported $event)
    {
        $student = $event->student;

        // Check if a record already exists in derogatory_records
        $existingRecord = DerogatoryRecord::where('student_id_number', $student->student_id_number)->first();

        if (!$existingRecord) {
            // Create a new record in derogatory_records
            DerogatoryRecord::create([
                'student_id_number' => $student->student_id_number,
                'last_name' => $student->last_name,
                'first_name' => $student->first_name,
                'middle_name' => $student->middle_name,
                'year_level' => $student->year_level,
                'school_year' => $student->school_year,
                'enrollment_status' => $student->enrollment_status,
                'graduation_date' => $student->graduation_date,
                'violation' => null, // Default value
                'action_taken' => null, // Default value
                'settled' => false, // Default value
                'sanction' => null, // Default value
            ]);
        }
    }
}
