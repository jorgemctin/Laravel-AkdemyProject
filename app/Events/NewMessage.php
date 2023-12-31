<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;

    /**
     * Create a new event instance.
     *
     * @param mixed $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        // error_log('Emitiendo evento NewMessage: ' . json_encode($this->message));
        // info('Emitiendo evento NewMessage: ' . json_encode($this->message));

        return new Channel('chat.' . $this->message->program_id);
    }
    /**
     * Get the name of the event for Pusher.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'NewMessage'; 
    }
}
