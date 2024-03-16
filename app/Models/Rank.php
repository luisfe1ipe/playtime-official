<?php

namespace App\Models;

use App\Traits\CustomGetImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rank extends Model
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
     * Get all of the findPlayersRankMin for the Rank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function findPlayersRankMin(): HasMany
    {
        return $this->hasMany(FindPlayer::class, 'rank_min_id');
    }


    /**
     * Get all of the findPlayersRankMax for the Rank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function findPlayersRankMax(): HasMany
    {
        return $this->hasMany(FindPlayer::class, 'rank_max_id');
    }
}
