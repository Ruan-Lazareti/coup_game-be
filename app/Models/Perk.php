<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Perk extends Model
{
    protected $fillable = [
        'perk',
	      'description'
    ];

    public function cards():belongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_perk');
    }
}
