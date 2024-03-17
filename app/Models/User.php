<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\CustomGetImage;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser

{
    use HasApiTokens, HasFactory, Notifiable, CustomGetImage;

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
        'points',
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
}
