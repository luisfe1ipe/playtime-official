<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    public function mount(string $nick)
    {
        $this->user = User::where('nick', $nick)->first();
    }

    public function render()
    {
        return view('livewire.user.profile');
    }
}
