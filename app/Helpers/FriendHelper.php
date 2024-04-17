<?php

namespace App\Helpers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class FriendHelper
{
  public static function getNotFriends(): Builder
  {
    $authId = Auth::user()->id;
    $friendsIds = Auth::user()->friends->pluck('id');

    $query = User::query();

    return $query->whereNotIn('id', $friendsIds)
      ->where('id', '!=', $authId);
  }
}
