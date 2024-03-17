<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FindPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'active',
        'position_id',
        'character_id',
        'game_id',
        'rank_min_id',
        'rank_max_id',
        'user_id'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function scopeActive(Builder $query, bool $active)
    {
        $query->where('active', $active);
    }


    /**
     * Get the user that owns the FindPlayer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the game that owns the FindPlayer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Get the position that owns the FindPlayer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the character that owns the FindPlayer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * Get the rankMin that owns the FindPlayer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rankMin(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'rank_min_id');
    }

    /**
     * Get the rankMax that owns the FindPlayer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rankMax(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'rank_max_id');
    }
}
