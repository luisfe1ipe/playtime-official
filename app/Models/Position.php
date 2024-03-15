<?php

namespace App\Models;

use App\Traits\CustomGetImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory, CustomGetImage;

    protected $fillable = [
        'name',
        'image',
        'game_id'
    ];

    /**
     * Get the game that owns the Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Get all of the findPlayers for the Position
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function findPlayers(): HasMany
    {
        return $this->hasMany(FindPlayer::class);
    }
}
