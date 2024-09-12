<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	protected $fillable = ['name', 'game_id', 'session_id'];

	public function game(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Game::class);
	}
}