<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
		protected $fillable =  ['current_player_id'];
    public function players(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Player::class);
    }
}
