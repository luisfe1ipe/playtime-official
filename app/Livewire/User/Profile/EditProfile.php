<?php

namespace App\Livewire\User\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfile extends Component
{
    public function mount(string $nick)
    {

    }

    public function render()
    {
        $this->authorize('update', Auth::user());
        $user = Auth::user();

        return view('livewire.user.profile.edit-profile', [
            'user' => $user
        ]);
    }
}
