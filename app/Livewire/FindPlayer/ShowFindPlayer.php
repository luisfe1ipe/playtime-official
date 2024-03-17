<?php

namespace App\Livewire\FindPlayer;

use App\Models\FindPlayer;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Encontrar Player | Visualizar vaga - PlayTime')]
class ShowFindPlayer extends Component
{
    public $vacancy;
    public $slug;

    public function mount($id)
    {
        $this->vacancy = FindPlayer::with(['user', 'character', 'position', 'rankMax', 'rankMin', 'game'])->find($id);

        if (!$this->vacancy) {
            return abort('404');
        }
    }

    #[On('refreshComponent')]
    public function render()
    {
        return view('livewire.find-player.show-find-player');
    }

    public function active()
    {
        $this->authorize('isAuthor', $this->vacancy);

        $this->vacancy->active = !$this->vacancy->active;
        $this->vacancy->save();

        if ($this->vacancy->active) {
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

    public function signUp()
    {
        $user = Auth::user();

        if($user->id == $this->vacancy->user_id)
        {
            return Notification::make()
                ->title('Inscrição não permitida')
                ->body('Você não pode se inscrever em sua própria vaga.')
                ->warning()
                ->send();
        }

        if (!$this->vacancy->findPlayerMembers->contains($user->id)) {
            $this->vacancy->findPlayerMembers()->attach($user->id);

            $this->dispatch('refreshComponent');

            return Notification::make()
                ->title('Inscrição realizada')
                ->body('Você foi inscrito com sucesso nesta vaga.')
                ->success()
                ->send();
        }

        $this->dispatch('refreshComponent');

        return Notification::make()
            ->title('Inscrição duplicada')
            ->body('Você já está inscrito nesta vaga.')
            ->danger()
            ->send();
    }

    public function unsubscribe()
    {
        $user = Auth::user();

        if ($this->vacancy->findPlayerMembers->contains($user->id)) {
            $this->vacancy->findPlayerMembers()->detach($user->id);

            $this->dispatch('refreshComponent');

            return Notification::make()
                ->title('Inscrição cancelada')
                ->body('Sua inscrição nesta vaga foi cancelada com sucesso.')
                ->success()
                ->send();
        }

        $this->dispatch('refreshComponent');

        return Notification::make()
            ->title('Inscrição não encontrada')
            ->body('Você não está inscrito nesta vaga.')
            ->danger()
            ->send();
    }
}
