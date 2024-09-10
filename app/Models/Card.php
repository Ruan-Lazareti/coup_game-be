<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image'
    ];

    public function perks(): belongsToMany
    {
        return $this->belongsToMany(Perk::class, 'card_perk');
    }
}
