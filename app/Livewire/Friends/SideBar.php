<?php

namespace App\Livewire\Friends;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SideBar extends Component
{
    public function render()
    {
        $receivedFriendRequestsCount = Auth::user()->receivedFriendRequests->count();

        return view('livewire.friends.side-bar', [
            'receivedFriendRequestsCount' => $receivedFriendRequestsCount
        ]);
    }
}
