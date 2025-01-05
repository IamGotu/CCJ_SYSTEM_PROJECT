<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DerogatoryRecordUpdated
{
    use Dispatchable, SerializesModels;

    public $studentId;
    public $violationId;
    public $penalty;
    public $actionTaken;
    public $settled;

    public function __construct($studentId, $violationId, $penalty, $actionTaken, $settled)
    {
        $this->studentId = $studentId;
        $this->violationId = $violationId;
        $this->penalty = $penalty;
        $this->actionTaken = $actionTaken;
        $this->settled = $settled;
    }
}