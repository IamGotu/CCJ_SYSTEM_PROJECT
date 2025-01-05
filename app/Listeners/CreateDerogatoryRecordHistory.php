<?php

namespace App\Listeners;

use App\Events\DerogatoryRecordUpdated;
use App\Models\DerogatoryRecordHistory;

class CreateDerogatoryRecordHistory
{
    public function handle(DerogatoryRecordUpdated $event)
    {
        // Create history record based on the event data
        DerogatoryRecordHistory::create([
            'student_id_number' => $event->studentId,
            'violation_id' => $event->violationId,
            'penalty' => $event->penalty,
            'action_taken' => $event->actionTaken,
            'settled' => $event->settled,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}