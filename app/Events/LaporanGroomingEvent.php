<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class LaporanGroomingEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $userId;

    /**
     * Create a new event instance.
     */
    public function __construct($name, $userId)
    {
        $this->name = $name;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('popup-notifications-grooming'),
        ];
    }

    /**
     * Broadcast the event cleaner input laporan.
     *
     * @return array
     */
    public function broadcastAs()
    {
        // if (Auth::user()->level == 'spv' && $this->userId = Auth::user()->id_users){
        //     return 'reports-grooming-spv-to-cleaner';
        // }
        // elseif (Auth::user()->level == 'cleaner'){
        //     return 'reports-grooming-cleaner-to-spv';
        // }
        return 'reports-grooming';
    }
}
