<?php

namespace App\Livewire\FindPlayer;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class SelectGame extends Component
{
    public $games;

    public array $items = [];

    public function mount()
    {
        // Auth::loginUsingId(13);
        $this->games = Game::active(true)->get();
    }

    public function render()
    {
        return view('livewire.find-player.select-game');
    }
}
