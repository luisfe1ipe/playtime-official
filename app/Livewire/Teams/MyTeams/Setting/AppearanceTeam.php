<?php

namespace App\Livewire\Teams\MyTeams\Setting;

use App\Models\Team;
use Livewire\Component;

class AppearanceTeam extends Component
{
    public $team;
    
    public function mount(string $slug)
    {
        $this->team = Team::where("slug", $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.teams.my-teams.setting.appearance-team');
    }
}
