<?php

namespace App\Helpers;

use App\Enums\FriendStatus;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class FriendHelper
{

  public static function getFriend(string|int $user_id): Friend
  {
    $friend =
      Friend::where(function ($query) use ($user_id) {
        $query->where('user_origin', $user_id)
          ->where('user_destination', Auth::user()->id);
      })->orWhere(function ($query) use ($user_id) {
        $query->where('user_origin', Auth::user()->id)
          ->where('user_destination', $user_id);
      })->with(['userOrigin', 'userDestination', 'messages'])->first();
    
    return $friend;
  }

  public static function getReceivedFriendRequestsCount(): int
  {
    return Auth::user()->receivedFriendRequests->count();
  }

  public static function getFriendsCount(): int
  {
    return Auth::user()->friends->count();
  }

  public static function getNotFriends(): Builder
  {
    $authId = Auth::user()->id;
    $friendsIds = Auth::user()->friends->pluck('id');

    $query = User::query();

    return $query->whereNotIn('id', $friendsIds)
      ->where('id', '!=', $authId);
  }

  public static function acceptFriendship(string|int $friendship_id): void
  {
    $friendship = Friend::find($friendship_id);

    $friendship->status = FriendStatus::ACCEPTED->getName();
    $friendship->save();
  }

  public static function recuseFriendship(string|int $friendship_id): void
  {
    $friendship = Friend::find($friendship_id);
    $friendship->delete();
  }
}
