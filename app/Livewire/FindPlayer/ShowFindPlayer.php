<?php

namespace App\Livewire\FindPlayer;

use App\Models\FindPlayer;
use Filament\Notifications\Notification;
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

    public function active()
    {
        $this->authorize('isAuthor', $this->vacancy);

        $this->vacancy->active = !$this->vacancy->active;
        $this->vacancy->save();

        if($this->vacancy->active)
        {
            return Notification::make()
                ->title('Vaga ativada com sucesso.')
                ->success()
                ->send();
        }

        return Notification::make()
            ->title('Vaga desativada com sucesso.')
            ->success()
            ->send();
    }

    public function delete()
    {
        $this->authorize('isAuthor', $this->vacancy);

        $this->vacancy->delete();

        Notification::make()
            ->title('Vaga excluída com sucesso.')
            ->success()
            ->send();
            
        return $this->redirect('/encontrar-player/' . $this->vacancy->game->slug, true);
    }
}
