<?php

namespace App\Livewire\Friends\SideBar;

use Livewire\Attributes\On;
use Livewire\Component;

class CountNavlink extends Component
{
    public $count = 0;

    public function mount(int $count)
    {
        $this->count = $count;
    }

    public function render()
    {
        return view('livewire.friends.side-bar.count-navlink');
    }
}
