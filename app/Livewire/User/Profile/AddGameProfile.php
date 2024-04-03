<?php

namespace App\Livewire\User\Profile;

use App\Models\Game;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
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

    public function rules()
    {
        return [
            'description' => ['string', 'nullable'],
            'characters_select' => [Rule::requiredIf($this->game_select->has_characters)],
            'positions_select' => ['required'],
            'rank_select' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'positions_select.required' => 'Por favor, selecione ao menos uma posição.',
            'characters_select.required' => 'Por favor, selecione ao menos um personagem.',
            'rank_select.required' => 'Por favor, selecione seu rank.',
        ];
    }

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
        $this->validate();

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

        Notification::make()
            ->title('Jogo adicionado com sucesso!')
            ->body('Você adicionou o jogo ao seu perfil com sucesso.')
            ->success()
            ->send();
    }
}
