<?php

namespace App\Events;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TripAccepted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $trip;
    private $user;
    //instantiate the attribue
    public function __construct(Trip $trip, User $user)
    {
        //passed through the frontend
        //we can easy retrieve the userId from here. ( the validated user that is being associated with this)
        $this->trip =$trip;
        $this->user=$user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        //channel (frontend pulling information)
        return [
            new Channel('passenger_' . $this->user->id)
        ];
    }
}
