<?php

namespace App\Livewire\Friends;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.friend-layout')]
class FriendshipRequests extends Component
{
    public function render()
    {
        $receivedFriendRequests = Auth::user()->receivedFriendRequests->all();

        return view('livewire.friends.friendship-requests', [
            'receivedFriendRequests' => $receivedFriendRequests
        ]);
    }
}
