<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
	protected $fillable = ['name', 'game_id', 'session_id'];

	public function game(): BelongsTo
	{
		return $this->belongsTo(Game::class);
	}

	public function playerCard() : HasMany
	{
		return $this->hasMany(PlayerCard::class);
	}
}