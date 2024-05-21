<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Times - PlayTime')]
class ListTeams extends Component
{
    use WithPagination;

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

        $this->resetPage();

        return view('livewire.teams.list-teams', [
            'teams' => $teams,
        ]);
    }
}
