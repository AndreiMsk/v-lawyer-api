<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Channel as ChatChannel;
use App\Models\Message;

class EventMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channel;
    public $message;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatChannel $channel, Message $message)
    {
        $this->channel = $channel;
        $this->message = $message;
    }


    public function broadcastOn()
    {
        return ['my-chat-channel'];
        // return [$this->channel->name];
    }
  
    public function broadcastAs()
    {
        return 'message-sent';
    }

}
