<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\FriendStatus;
use App\Traits\CustomGetImage;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;

class User extends Authenticatable implements FilamentUser

{
    use HasApiTokens, HasFactory, Notifiable, CustomGetImage, HasMergedRelationships;

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '@playtime.com') && $this->hasVerifiedEmail();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nick',
        'slug_nick',
        'photo',
        'banner',
        'email',
        'birth',
        'is_blocked',
        'likes',
        'bio',
        'google_id',
        'google_token',
        'google_refresh_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'is_blocked' => 'boolean',
    ];



    public function friends()
    {
        return $this->mergedRelationWithModel(User::class, 'friends_view');
    }


    /**
     * The games that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_user', 'user_id', 'game_id')
            ->withPivot(['rank_id', 'description', 'days_times_play', 'positions', 'characters'])
            ->withTimestamps();
    }

    /**
     * Get all of the news for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function isTeamLeader(string $slug)
    {
        return $this->teams()->where('slug', $slug)->where('user_id', $this->id)->exists();
    }

    /**
     * Get all of the teams for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Get all of the findPlayers for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function findPlayers(): HasMany
    {
        return $this->hasMany(FindPlayer::class);
    }

    /**
     * The findPlayerMembers that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function findPlayerMembers(): BelongsToMany
    {
        return $this->belongsToMany(FindPlayer::class, 'find_player_user',)
            ->withPivot('status')
            ->withTimestamps();
    }

    /**
     * The friendsOfMine that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friendsOfMine(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_origin', 'user_destination')
            ->wherePivot('status', FriendStatus::ACCEPTED)
            ->withPivot('user_origin', 'user_destination', 'status')
            ->withTimestamps();
    }

    /**
     * The friendOf that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friendOf(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_destination', 'user_origin')
            ->wherePivot('status', FriendStatus::ACCEPTED)
            ->withPivot('user_origin', 'user_destination', 'status')
            ->withTimestamps();
    }

    public function sentFriendRequests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_origin', 'user_destination')
            ->wherePivot('status', FriendStatus::PENDING)
            ->withPivot('id', 'user_destination', 'user_origin', 'status')
            ->withTimestamps();
    }

    public function receivedFriendRequests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_destination', 'user_origin')
            ->wherePivot('status', FriendStatus::PENDING)
            ->withPivot('id', 'user_destination', 'user_origin', 'status')
            ->withTimestamps();
    }
}
