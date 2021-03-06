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

class EventChannel implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channel;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatChannel $channel)
    {
        $this->channel = $channel;
    }


    public function broadcastOn()
    {
        return ['admin-channel'];
    }
  
    public function broadcastAs()
    {   
        return 'channel-created';
    }

    public function broadcastWith()
    {   
        return [
            'id' => $this->channel->id,
            'name' => $this->channel->name,
            'status' => $this->channel->status,
            'messages' => []
            // 'messages' => $this->channel->messages
        ];
    }

}
