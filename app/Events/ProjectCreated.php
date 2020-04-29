<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username, $project)
    {
        $this->username = $username;
        $this->message  = "{$username} created {$project}";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['project-created'];
    }
}
