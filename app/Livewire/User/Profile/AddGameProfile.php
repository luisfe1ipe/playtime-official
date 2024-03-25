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

    public array $characters_select = [];
    public array $positions_select = [];
    public array $rank_select = [];


    public function render()
    {
        $this->authorize('update', Auth::user());
        $user = Auth::user();
        $games = Game::all();

        // if ($this->game_select_id) {
        $this->game_select = Game::with(['positions', 'characters', 'ranks'])->find(1);
        // }

        return view('livewire.user.profile.add-game-profile', [
            'user' => $user,
            'games' => $games
        ]);
    }

    public function save()
    {
        // $user = Auth::user();
        // $user->games()->create([
        //     'game_id' => $this->game_select->id,
        //     'user_id' => $user->id,
        //     'rank_id' => $this->rank_select,
        //     // 'description' => $this->description,
        //     ''
        // ])
    }
}
