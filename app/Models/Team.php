<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'banner',
        'slug',
        'description',
        'email',
        'site_url',
        'discord_url',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'twitter_url',
        'twitch_url',
        'user_id',
    ];

    /**
     * Get the user that owns the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The inviteUsers that belong to the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inviteUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'invite_team_user')
            ->withPivot('accepted')
            ->withTimestamps();
    }

    /**
     * The members that belong to the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'member_team')
            ->withTimestamps();
    }
}
