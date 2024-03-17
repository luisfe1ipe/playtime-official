<?php

namespace App\Livewire\FindPlayer;

use App\Models\FindPlayer as ModelsFindPlayer;
use App\Models\Game;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Encontrar Player - PlayTime')]
class FindPlayer extends Component
{
    use WithPagination;

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
        $vacancies = ModelsFindPlayer::where('game_id', $this->game->id)->with(['character', 'position', 'rankMin', 'rankMax'])->paginate(16);

        return view('livewire.find-player.find-player', [
            'vacancies' => $vacancies
        ]);
    }
}
