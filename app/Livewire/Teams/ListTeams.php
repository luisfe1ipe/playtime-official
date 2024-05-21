<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Livewire\Component;

class ListTeams extends Component
{
    public $search;
    public $selectedOrder = 'desc';

    public function render()
    {
        $teams = Team::query();

        if ($this->search) {
            $teams->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->selectedOrder != 'desc') {
            $teams->orderBy('created_at', 'asc');
        } else {
            $teams->orderBy('created_at', 'desc');
        }

        $teams = $teams->paginate(16);

        $team = Team::where('user_id', 202)->first();

        return view('livewire.teams.list-teams', [
            'teams' => $teams,
            'team' => $team
        ]);
    }
}
