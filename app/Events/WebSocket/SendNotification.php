<?php

namespace App\Events\WebSocket;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user_id;
    private $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id,$message)
    {
        $this->user_id = $user_id;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.'. $this->user_id);
    }

    public function broadcastAs()
    {
        return 'SendNotification';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }
}
