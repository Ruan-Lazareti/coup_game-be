<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PlayerJoined implements ShouldBroadcast
{
    public $nickname;
    public $gameId;
    public function __construct($nickname, $gameId)
    {
        $this->nickname = $nickname;
        $this->gameId = $gameId;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('game.' . $this->gameId);
    }
}
