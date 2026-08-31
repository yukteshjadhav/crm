<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewLeadAssigned implements ShouldBroadcastNow
{
    public $data;
    public $assignedTo;

    public function __construct($data, $assignedTo)
    {
        $this->data = $data;
        $this->assignedTo = $assignedTo;
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('user.' . 1),
            new PrivateChannel('user.' . $this->assignedTo),
        ];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

    public function broadcastWith(): array
    {
        return [
            'id'      => $this->data['id'] ?? '',
            'name'    => $this->data['name'] ?? '',
            'mobile'  => $this->data['mobile'] ?? '',
            'message' => $this->data['message'] ?? '',
        ];
    }
}