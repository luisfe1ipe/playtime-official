<?php

namespace App\Livewire\FindPlayer;

use App\Models\Character;
use App\Models\FindPlayer as ModelsFindPlayer;
use App\Models\Game;
use App\Models\Position;
use App\Models\Rank;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Encontrar Player - PlayTime')]
class FindPlayer extends Component
{
    use WithPagination;

    public $game;
    public $search = '';

    public  $position_id;
    public  $character_id;
    public  $rank_min_id;
    public  $rank_max_id;

    public $selectedOrder;


    public function mount(string $slug)
    {
        $this->game = Game::where('slug', $slug)->with('ranks', 'characters', 'positions')->first();
        $this->selectedOrder = 'desc';
        if (!$this->game) {
            abort(404);
        }
    }

    public function render()
    {
        $vacancies = ModelsFindPlayer::query()
            ->where('game_id', $this->game->id)
            ->where('active', true)
            ->with(['character', 'position', 'rankMin', 'rankMax']);

        if ($this->selectedOrder) {
            $vacancies->orderBy('created_at', $this->selectedOrder);
        }

        if ($this->search) {
            $vacancies->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('id', $this->search);
            });
        }

        if ($this->position_id) {
            $vacancies->where(function ($query) {
                $query->where('position_id', $this->position_id);
            });
        }

        if ($this->character_id) {
            $vacancies->where(function ($query) {
                $query->where('character_id', $this->character_id);
            });
        }

        if ($this->rank_min_id) {
            $vacancies->where(function ($query) {
                $query->where('rank_min_id', $this->rank_min_id);
            });
        }

        if ($this->rank_max_id) {
            $vacancies->where(function ($query) {
                $query->where('rank_max_id', $this->rank_max_id);
            });
        }

        $vacancies = $vacancies->paginate(16);

        return view('livewire.find-player.find-player', [
            'vacancies' => $vacancies
        ]);
    }


    #[On('select-item')]
    public function setItem($item)
    {
        if ($item['value'] == null) {
            match ($item['model']) {
                Character::class => $this->character_id = null,
                Position::class => $this->position_id = null,
                Rank::class => match ($item['wire_model']) {
                    'rank_min' => $this->rank_min_id = null,
                    'rank_max' => $this->rank_max_id = null,
                }
            };

            return;
        }

        match ($item['model']) {
            Character::class => $this->character_id = $item['value']['id'],
            Position::class => $this->position_id = $item['value']['id'],
            Rank::class => match ($item['value']['wire_model']) {
                'rank_min' => $this->rank_min_id = $item['value']['id'],
                'rank_max' => $this->rank_max_id = $item['value']['id'],
            },
        };
    }
}
