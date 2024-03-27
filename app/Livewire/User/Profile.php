<?php

namespace App\Livewire\User;

use App\Models\Character;
use App\Models\Game;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    public $game_select;
    public $characters;
    public $positions;

    public function mount(string $nick)
    {
        $this->user = User::where('nick', $nick)->with(['games'])->first();
        $this->game_select = $this->user->games->first();

        if($this->game_select)
        {
            self::setGameInformation();
        }
    }

    public function render()
    {
        return view('livewire.user.profile');
    }

    public function selectGame($id)
    {
        $this->game_select = $this->user->games->find($id);

        self::setGameInformation();
    }

    private function setGameInformation(): void
    {
        if ($this->game_select->has_characters) {
            $this->characters = Character::select('name', 'image')->whereIn('id', json_decode($this->game_select->pivot->characters))->get();
        }

        $this->positions = Position::select('name', 'image')->whereIn('id', json_decode($this->game_select->pivot->positions))->get();
    }
}
