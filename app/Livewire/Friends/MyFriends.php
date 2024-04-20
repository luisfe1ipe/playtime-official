<?php

namespace App\Livewire\Friends;

use App\Helpers\FriendHelper;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.friend-layout')]
class MyFriends extends Component
{

    public $search;

    public function render()
    {
        $friends = Auth::user()->friends();

        if($this->search)
        {
            $friends->where('nick', 'LIKE', '%' . $this->search . '%');
        }

        $friends = $friends->paginate(12);

        return view('livewire.friends.my-friends', [
            'friends' => $friends
        ]);
    }

    public function deleteFriend(string|int $friend_id)
    {
        FriendHelper::recuseFriendship($friend_id);

        // $this->dispatch('refresh-sidebar');

        return Notification::make()
            ->title('Amizade excluída com sucesso!')
            ->success()
            ->send();
    }
}
