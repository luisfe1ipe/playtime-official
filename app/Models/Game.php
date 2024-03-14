<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'photo',
        'alternative_photo',
        'banner',
        'has_characters',
        'active',
    ];

    protected $casts = [
        'has_characters' => 'boolean',
        'active' => 'boolean',
    ];

    public function scopeActive(Builder $query, bool $active)
    {
        $query->where('active', $active);
    }

    /**
     * Get all of the characters for the Game
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranks(): HasMany
    {
        return $this->hasMany(Rank::class);
    }

    /**
     * Get all of the characters for the Game
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }

    /**
     * Get all of the positions for the Game
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    /**
     * Get all of the findPlayers for the Game
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function findPlayers(): HasMany
    {
        return $this->hasMany(FindPlayer::class);
    }
}
