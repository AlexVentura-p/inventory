<?php

namespace App\Events;

use App\Models\Rating;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreRatingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ratings;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Rating $ratings)
    {
        $this->ratings = $ratings;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
