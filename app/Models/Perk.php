<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Perk extends Model
{
    protected $table = 'perks';

    protected $fillable = [
        'id',
        'perk'
    ];

    public function cards():belongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_perk');
    }
}
