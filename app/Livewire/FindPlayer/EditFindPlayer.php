<?php

namespace App\Livewire\Findplayer;

use App\Models\Character;
use App\Models\FindPlayer;
use App\Models\Position;
use App\Models\Rank;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class EditFindPlayer extends Component
{
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

    public $vacancy;

    public function mount($id)
    {
        $this->vacancy = FindPlayer::with(['game', 'character', 'position', 'rankMin', 'rankMax'])->find($id);

        if(Auth::user()->id != $this->vacancy->user_id)
        {
            return abort('403');
        }

        $this->title = $this->vacancy->title;
        $this->description = $this->vacancy->description;
        $this->position_id = $this->vacancy->position_id;
        $this->character_id = $this->vacancy->character_id;
        $this->rank_min_id = $this->vacancy->rank_min_id;
        $this->rank_max_id = $this->vacancy->rank_max_id;

        $this->dispatch('teste', [
            'character_id' => $this->character_id,
            'position_id' => $this->position_id,
            'rank_min_id' => $this->rank_min_id,
            'rank_max_id' => $this->rank_max_id,
        ]);
    }

    public function render()
    {
        $this->characters = Character::where('game_id', $this->vacancy->game->id)->orderBy('name', 'asc')->get();
        $this->positions = Position::where('game_id', $this->vacancy->game->id)->orderBy('name', 'asc')->get();
        $this->ranks = Rank::where('game_id', $this->vacancy->game->id)->orderBy('name', 'asc')->get();

        return view('livewire.findplayer.edit-find-player');
    }

    #[On('select-item')]
    public function setItem($item)
    {
        if ($item['value'] == null) {
            switch ($item) {
                case $item['model'] === Character::class:
                    $this->character_id = null;
                    break;
                case $item['model'] === Position::class:
                    $this->position_id = null;
                    break;
                case $item['model'] === Rank::class && $item['wire_model'] === 'rank_min':
                    $this->rank_min_id = null;
                    break;
                case $item['model'] === Rank::class && $item['wire_model'] === 'rank_max':
                    $this->rank_max_id = null;
                    break;
            }

            return;
        }

        switch ($item) {
            case $item['model'] === Character::class:
                $this->character_id = $item['value']['id'];
                break;
            case $item['model'] === Position::class:
                $this->position_id = $item['value']['id'];
                break;
            case $item['model'] === Rank::class && $item['value']['wire_model'] === 'rank_min':
                $this->rank_min_id = $item['value']['id'];
                break;
            case $item['model'] === Rank::class && $item['value']['wire_model'] === 'rank_max':
                $this->rank_max_id = $item['value']['id'];
                break;
        }
    }

    public function save()
    {
        $this->validate();

        $this->vacancy->update([
            'title' => $this->title,
            'description' => $this->description,
            'character_id' => $this->character_id,
            'position_id' => $this->position_id,
            'rank_min_id' => $this->rank_min_id,
            'rank_max_id' => $this->rank_max_id,
        ]);

        $this->vacancy->save();

        Notification::make()
            ->title('Vaga atualizada com sucesso!')
            ->body('Sua vaga foi atualizada com sucesso.')
            ->success()
            ->send();

        return $this->redirect('/encontrar-player/vaga/' . $this->vacancy->id, navigate: true);
    }
}
