<?php

namespace App\Livewire\FindPlayer;

use App\Models\Game;
use Livewire\Component;

class FindPlayer extends Component
{
    public $game;

    public function mount(string $slug)
    {
        $this->game = Game::where('slug', $slug)->first();

        if(!$this->game)
        {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.find-player.find-player');
    }
}
