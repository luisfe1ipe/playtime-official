<?php

namespace App\Livewire\FindPlayer;

use App\Models\Character;
use App\Models\FindPlayer;
use App\Models\Game;
use App\Models\Position;
use App\Models\Rank;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Encontrar Player | Anunciar vaga - Playtime')]
class FormFindPlayer extends Component
{
    public $game;


    #[Validate('required')]
    public  $title;

    #[Validate('required')]
    public  $description;

    #[Validate('exists:positions,id|nullable')]
    public  $position_id;

    #[Validate('exists:characters,id|nullable')]
    public  $character_id;

    #[Validate('exists:ranks,id|required')]
    public  $rank_min_id;

    #[Validate('exists:ranks,id|nullable')]
    public  $rank_max_id;

    public  $game_id;

    public $character_select = null;
    public $characters;
    public $positions;
    public $ranks;

    public $searchCharacter = '';

    public function mount(string $slug)
    {
        $this->game = Game::where('slug', $slug)->first();
        $this->game_id = $this->game->id;
    }

    public function render()
    {
        $this->characters = Character::where('game_id', $this->game_id)->orderBy('name', 'asc')->get();
        $this->positions = Position::where('game_id', $this->game_id)->orderBy('name', 'asc')->get();
        $this->ranks = Rank::where('game_id', $this->game_id)->orderBy('name', 'asc')->get();

        return view('livewire.find-player.form-find-player');
    }

    #[On('select-item')]
    public function setItem($item)
    {
        ds($item);
        switch ($item) {
            case $item['model'] === Character::class:
                $this->character_id = $item['id'];
                break;
            case $item['model'] === Position::class:
                $this->position_id = $item['id'];
                break;
            case $item['model'] === Rank::class && $item['wire_model'] === 'rank_min':
                $this->rank_min_id = $item['id'];
            case $item['model'] === Rank::class && $item['wire_model'] === 'rank_max':
                $this->rank_max_id = $item['id'];
        }
    }

    public function save()
    {
        $this->validate();

        FindPlayer::create([
            'title' => $this->title,
            'description' => $this->description,
            'active' => true,
            'game_id' => $this->game->id,
            'rank_min_id' => $this->rank_min_id,
            'rank_max_id' => $this->rank_max_id,
            'character_id' => $this->character_id,
            'position_id' => $this->position_id,
            'user_id' => Auth::user()->id
        ]);

        Notification::make()
            ->title('Vaga criada com sucesso!')
            ->body('Sua vaga foi criada com sucesso. Agora outros jogadores podem se juntar a você para jogar.')
            ->success()
            ->send();

        return $this->redirect('/encontrar-player/' . $this->game->slug, navigate: true);
    }
}
