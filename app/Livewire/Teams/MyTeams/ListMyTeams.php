<?php

namespace App\Livewire\Teams\MyTeams;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

class ListMyTeams extends Component
{
    #[Validate([
        'required',
        'unique:teams,name'
    ])]
    public $name;

    public function render()
    {
        $myTeams = Team::where('user_id', Auth::user()->id)->get();

        return view('livewire.teams.my-teams.list-my-teams', [
            'myTeams' => $myTeams
        ]);
    }

    public function submit()
    {

        $this->validate();

        Team::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'user_id' => Auth::user()->id,
        ]);

        $this->reset();
        $this->dispatch('close-modal');
    }
}
