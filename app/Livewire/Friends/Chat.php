<?php

namespace App\Livewire\Friends;

use App\Helpers\FriendHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.chat-layout')]
class Chat extends Component
{
    public $search = '';
    public $searchChat = '';

    public function render()
    {
        $users = FriendHelper::getNotFriends();
        $friends = Auth::user()->friends()->getQuery();


        if ($this->search) {
            $users->where('nick', 'like', '%' . $this->search . '%');
            $users = $users->get();
        }

        if ($this->searchChat) {
            $friendsIds = Auth::user()->friends->pluck('id');
            $friends =
                User::whereIn('id', $friendsIds)
                ->where('nick', 'like', '%' . $this->searchChat . '%');
        }

        $friends = $friends->get();

        return view('livewire.friends.chat', [
            'users' => $users,
            'friends' => $friends
        ]);
    }

    #[On('reset-search')]
    public function resetSearch()
    {
        $this->reset('search');
    }

    public function searchUserInChat(string $search)
    {
        $this->searchChat = $search;
        $this->dispatch('close-modal');
    }
}
