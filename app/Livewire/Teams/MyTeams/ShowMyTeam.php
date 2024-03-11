<?php

namespace App\Livewire\Teams\MyTeams;

use App\Models\Team;
use Livewire\Component;

class ShowMyTeam extends Component
{
    public $team;

    public function mount(string $slug)
    {
        $this->team = Team::where('slug', $slug)->with('user')->firstOrFail();

    }
    public function render()
    {
        return view('livewire.teams.my-teams.show-my-team');
    }
}
