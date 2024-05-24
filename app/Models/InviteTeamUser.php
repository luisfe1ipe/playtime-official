<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteTeamUser extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'invite_team_user';

    protected $fillable = [
        'team_id',
        'user_id',
        'accepted'
    ];

    protected $casts = [
        'accepted' => 'boolean'
    ];
}
