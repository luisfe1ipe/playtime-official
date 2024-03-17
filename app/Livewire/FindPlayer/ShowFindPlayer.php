<?php

namespace App\Livewire\FindPlayer;

use App\Models\FindPlayer;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Encontrar Player | Visualizar vaga - PlayTime')]
class ShowFindPlayer extends Component
{
    public $vacancy;
    public $slug;

    public function mount($id)
    {
        $this->vacancy = FindPlayer::with(['user', 'character', 'position', 'rankMax', 'rankMin','game'])->find($id);

        if (!$this->vacancy) {
            return abort('404');
        }
    }

    public function render()
    {
        return view('livewire.find-player.show-find-player');
    }
}
