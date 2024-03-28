<?php

namespace App\Livewire\User\Profile;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class EditGameProfile extends Component
{
    public $user;
    public $game;
    public $game_user_id;

    public string $description;
    public array $characters_select = [];
    public array $positions_select = [];
    public array $days_times_play = [];
    public int $rank_select;

    #[On('refreshPage')]
    public function mount(string $nick, int $game_user_id)
    {
        $this->game_user_id = $game_user_id;

        $this->user = User::where('nick', $nick)->first();
        if ($this->user->nick != Auth::user()->nick) {
            return abort(403);
        }

        $this->game = $this->user->games()->with(['characters', 'positions', 'ranks'])->where('game_user.id', $game_user_id)->first();


        $this->characters_select = json_decode($this->game->pivot->characters);
        $this->positions_select = json_decode($this->game->pivot->positions);
        $this->rank_select = $this->game->pivot->rank_id;
        $this->days_times_play = json_decode($this->game->pivot->days_times_play, true);
        $this->description = $this->game->pivot->description;
    }

    public function render()
    {
        return view('livewire.user.profile.edit-game-profile');
    }

    public function save()
    {
        $this->user->games()->updateExistingPivot(
            $this->game_user_id,
            [
                'rank_id' => $this->rank_select,
                'description' => $this->description,
                'days_times_play' => json_encode($this->days_times_play),
                'positions' => json_encode($this->positions_select),
                'characters' => json_encode($this->characters_select),
            ]
        );

        $this->redirect(route('profile', ['nick' => $this->user->nick]), navigate: true);

        return Notification::make()
            ->title('Informações atualizadas com sucesso.')
            ->success()
            ->send();
    }
}
