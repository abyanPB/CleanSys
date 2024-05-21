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

class LaporanPjkpEvent implements ShouldBroadcast
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
            new Channel('popup-notifications-pjkp'),
        ];
    }

    /**
     * Broadcast the event cleaner input laporan.
     *
     * @return array
     */
    public function broadcastAs()
    {
        // if (Auth::user()->level == 'spv'){
        //     return 'reports-pjkp-spv-to-cleaner';
        // }
        // elseif (Auth::user()->level == 'cleaner'){
        //     return 'reports-pjkp-cleaner-to-spv';
        // }
        return 'reports-pjkp';
    }
}
