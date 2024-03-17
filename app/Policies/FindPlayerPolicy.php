<?php

namespace App\Policies;

use App\Models\FindPlayer;
use App\Models\User;

class FindPlayerPolicy
{
    public function isAuthor(User $user, FindPlayer $findPlayer)
    {
        return $user->id === $findPlayer->user_id;
    }
}
