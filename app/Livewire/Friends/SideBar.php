<?php

namespace App\Livewire\Friends;

use App\Helpers\FriendHelper;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class SideBar extends Component
{
    public function render()
    {
        $receivedFriendRequestsCount = FriendHelper::getCountreceivedFriendRequests();

        return view('livewire.friends.side-bar', [
            'receivedFriendRequestsCount' => $receivedFriendRequestsCount
        ]);
    }
}
