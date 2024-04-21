<?php

namespace App\Livewire\Friends;

use App\Helpers\FriendHelper;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class SideBar extends Component
{
    public $search;

    public function render()
    {
        $receivedFriendRequestsCount = FriendHelper::getReceivedFriendRequestsCount();
        $friendsCount = FriendHelper::getFriendsCount();
        $users = FriendHelper::getNotFriends();

        if ($this->search) {
            $users->where('nick', 'like', '%' . $this->search . '%');
            $users = $users->get();
        }

        return view('livewire.friends.side-bar', [
            'receivedFriendRequestsCount' => $receivedFriendRequestsCount,
            'friendsCount' => $friendsCount,
            'users' => $users
        ]);
    }

}
