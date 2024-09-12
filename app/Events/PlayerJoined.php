<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PlayerJoined implements ShouldBroadcast
{
    public $player;
    public function __construct($player)
    {
			$this->player = $player;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('game.' . $this->player->game_id);
    }
}
