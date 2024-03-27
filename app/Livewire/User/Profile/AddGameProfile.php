<?php

namespace App\Livewire\User\Profile;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Adicionar jogo - PlayTime')]
class AddGameProfile extends Component
{
    public $game_select_id;
    public $game_select;

    public string $description;
    public array $characters_select = [];
    public array $positions_select = [];
    public array $days_times_play = [];
    public int $rank_select;

    public function mount(string $nick)
    {
    }

    public function render()
    {
        $this->authorize('update', Auth::user());
        $user = Auth::user();
        $games = Game::all();

        if ($this->game_select_id) {
            $this->game_select = Game::with(['positions', 'characters', 'ranks'])->find($this->game_select_id);
        }


        return view('livewire.user.profile.add-game-profile', [
            'user' => $user,
            'games' => $games
        ]);
    }

    public function save()
    {

        $user = Auth::user();

        $user->games()->attach(
            $this->game_select->id,
            [
                'rank_id' => $this->rank_select,
                'description' => $this->description,
                'days_times_play' => json_encode($this->days_times_play),
                'positions' => json_encode($this->positions_select),
                'characters' => json_encode($this->characters_select),
            ]
        );
    }
}
