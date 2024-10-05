<?php

namespace App\Livewire\FindPlayer;

use App\Models\Character;
use App\Models\Game;
use App\Models\ManyToMany\FindPlayerUser;
use App\Models\Position;
use App\Models\Rank;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class MyRegistrations extends Component
{
    public $game_select;
    public $position_id;
    public $character_id;
    public $rank_min_id;
    public $rank_max_id;

    public $filters = [];

    public $selectedOrder;

    public function render()
    {
        $user = Auth::user();
        $vacancies = $user->findPlayerMembers()
            ->with(['character', 'position', 'rankMin', 'rankMax']);

        if ($this->game_select != null) {
            $vacancies->where('game_id', $this->game_select->id);
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

        if ($this->selectedOrder) {
            switch ($this->selectedOrder) {
                case 'desc':
                    $vacancies->orderBy('created_at', 'desc');
                    break;
                case 'asc':
                    $vacancies->orderBy('created_at', 'asc');
                    break;
                case 'active_false':
                    $vacancies->where('active', false);
                    break;
                case 'active_true':
                    $vacancies->where('active', true);
                    break;
                default:
                    # code...
                    break;
            }
        }

        $vacancies = $vacancies->paginate();

        $games = Game::all();



        return view('livewire.find-player.my-registrations', [
            'vacancies' => $vacancies,
            'games' => $games
        ]);
    }

    #[On('select-item')]
    public function setItem($item)
    {
        if ($item['value'] == null) {
            switch ($item) {
                case $item['model'] === Game::class:
                    $this->game_select = null;
                    $this->filters['game_select'] = null;
                    break;
                case $item['model'] === Character::class:
                    $this->character_id = null;
                    $this->filters['character'] = null;
                    break;
                case $item['model'] === Position::class:
                    $this->position_id = null;
                    $this->filters['position'] = null;
                    break;
                case $item['model'] === Rank::class && $item['wire_model'] === 'rank_min':
                    $this->rank_min_id = null;
                    $this->filters['rank_min'] = null;
                    break;
                case $item['model'] === Rank::class && $item['wire_model'] === 'rank_max':
                    $this->rank_max_id = null;
                    $this->filters['rank_max'] = null;
                    break;
            }
            return;
        }

        switch ($item) {
            case $item['model'] === Game::class:
                $this->game_select = Game::with(['characters', 'positions', 'ranks'])->find($item['value']['id']);
                $this->filters['game_select'] = $this->game_select;
                break;
            case $item['model'] === Character::class:
                $this->character_id = $item['value']['id'];
                $this->filters['character'] = Character::find($this->character_id);
                break;
            case $item['model'] === Position::class:
                $this->position_id = $item['value']['id'];
                $this->filters['position'] = Position::find($this->position_id);
                break;
            case $item['model'] === Rank::class && $item['value']['wire_model'] === 'rank_min':
                $this->rank_min_id = $item['value']['id'];
                $this->filters['rank_min'] = Rank::find($this->rank_min_id);
                break;
            case $item['model'] === Rank::class && $item['value']['wire_model'] === 'rank_max':
                $this->rank_max_id = $item['value']['id'];
                $this->filters['rank_max'] = Rank::find($this->rank_max_id);
                break;
        }
    }

    public function clearFilter()
    {
        $this->game_select = null;
        $this->filters['game_select'] = null;
        $this->character_id = null;
        $this->filters['character'] = null;
        $this->position_id = null;
        $this->filters['position'] = null;
        $this->rank_min_id = null;
        $this->filters['rank_min'] = null;
        $this->rank_max_id = null;
        $this->filters['rank_max'] = null;
    }
}
