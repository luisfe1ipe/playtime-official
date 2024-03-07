<?php

namespace App\Livewire\FindPlayer;

use App\Models\Game;
use Livewire\Component;

class SelectGame extends Component
{
    public $games;

    public function mount()
    {
        $this->games = Game::active(true)->get();
    }

    public function render()
    {
        return view('livewire.find-player.select-game');
    }
}
