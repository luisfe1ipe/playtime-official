<?php

namespace App\Livewire\Friends;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.chat-layout')]
class Chat extends Component
{
    public $search = '';
    public function render()
    {
        $users = User::query();

        if ($this->search) {
            $users->where('nick', 'like', '%' . $this->search . '%');
            $users = $users->get();
        }
        

        return view('livewire.friends.chat', [
            'users' => $users,
        ]);
    }
}
