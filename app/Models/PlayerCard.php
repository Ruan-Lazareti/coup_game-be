<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerCard extends Model
{
		use HasFactory;

		protected $table = 'player_card';

		protected $fillable = [
			'player_id',
			'card_id',
			'game_id',
		];

		public function player() : BelongsTo
		{
			return $this->belongsTo(Player::class);
		}

		public function card() : BelongsTo
		{
			return $this->belongsTo(Card::class);
		}

		public function game() : BelongsTo
		{
			return $this->belongsTo(Game::class);
		}
}
