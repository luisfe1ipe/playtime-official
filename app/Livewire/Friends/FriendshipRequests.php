<?php

namespace App\Livewire\Friends;

use App\Helpers\FriendHelper;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.friend-layout')]
#[Title('Solicitações de Amizade | PlayTime')]
class FriendshipRequests extends Component
{
    public $search;

    public function render()
    {
        $receivedFriendRequests = Auth::user()->receivedFriendRequests();

        if($this->search)
        {
            $receivedFriendRequests->where('nick', 'LIKE', '%'.$this->search.'%');
        }

        $receivedFriendRequests = $receivedFriendRequests->paginate(12);

        return view('livewire.friends.friendship-requests', [
            'receivedFriendRequests' => $receivedFriendRequests
        ]);
    }

    public function acceptFriend(string|int $friend_id)
    {
        FriendHelper::acceptFriendship($friend_id);

        $this->dispatch('refresh-sidebar', FriendHelper::getReceivedFriendRequestsCount());

        return Notification::make()
            ->title('Pedido de amizade aceito!')
            ->success()
            ->send();
    }

    public function recuseFriend(string|int $friend_id)
    {
        FriendHelper::recuseFriendship($friend_id);

        $this->dispatch('refresh-sidebar', FriendHelper::getReceivedFriendRequestsCount());

        return Notification::make()
            ->title('Pedido de amizade recusado!')
            ->success()
            ->send();
    }
}
