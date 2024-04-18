<?php

namespace App\Livewire\Friends;

use App\Helpers\FriendHelper;
use Filament\Notifications\Notification;
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

    public function acceptFriend(string|int $friend_id)
    {
        FriendHelper::acceptFriendship($friend_id);

        return Notification::make()
            ->title('Pedido de amizade aceito!')
            ->success()
            ->send();
    }
}
