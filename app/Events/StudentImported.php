<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentImported
{
    use SerializesModels;

    public $student;

    /**
     * Create a new event instance.
     *
     * @param array $student
     * @return void
     */
    public function __construct($student)
    {
        $this->student = $student;
    }
}
