<?php

namespace App\Livewire\Friends;

use App\Helpers\FriendHelper;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class SideBar extends Component
{
    public $receivedFriendRequestsCount, $friendsCount;

    public function render()
    {
        $receivedFriendRequestsCount = FriendHelper::getReceivedFriendRequestsCount();
        $friendsCount = FriendHelper::getFriendsCount();

        return view('livewire.friends.side-bar', [
            'receivedFriendRequestsCount' => $receivedFriendRequestsCount,
            'friendsCount' => $friendsCount,
        ]);
    }

}
