<?php

namespace App\Livewire\User;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateNickname extends Component
{
    public $game;

    #[Validate('required|unique:users,nick')]
    public $nick;

    public function render()
    {
        $this->game = Game::first();

        return view('livewire.user.create-nickname');
    }

    public function save()
    {
        $this->validate();

        $user = Auth::user();
        $user->nick = $this->nick;
        $user->save();

        return $this->redirect('/', navigate:true);
    }
}
