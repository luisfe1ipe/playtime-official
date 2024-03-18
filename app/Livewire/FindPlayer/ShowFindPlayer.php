<?php

namespace App\Livewire\FindPlayer;

use App\Enums\FindPlayerStatus;
use App\Events\UserSignedUpEvent;
use App\Models\FindPlayer;
use App\Notifications\UserSignedUp;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Encontrar Player | Visualizar vaga - PlayTime')]
class ShowFindPlayer extends Component
{
    use WithPagination;

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
        $registeredUsers = $this->vacancy->findPlayerMembers()->paginate(6);

        return view('livewire.find-player.show-find-player', [
            'registeredUsers' => $registeredUsers
        ]);
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

        if ($user->id == $this->vacancy->user_id) {
            return Notification::make()
                ->title('Inscrição não permitida')
                ->body('Você não pode se inscrever em sua própria vaga.')
                ->warning()
                ->send();
        }

        if (!$this->vacancy->findPlayerMembers->contains($user->id)) {
            $this->vacancy->findPlayerMembers()->attach($user->id);

            $this->dispatch('refreshComponent');

            $this->vacancy->user->notify( new UserSignedUp($this->vacancy, $user));
            
            UserSignedUpEvent::dispatch();

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

    public function acceptUser($id)
    {

        $vacancy = $this->vacancy->findPlayerMembers()->where('user_id', $id)->first();
        $vacancy->pivot->status = FindPlayerStatus::ACCEPTED;
        $vacancy->pivot->save();

        return Notification::make()
            ->title('Usuário aceito!')
            ->body('O usuário foi aceito com sucesso na vaga.')
            ->success()
            ->send();
    }

    public function refuseUser($id)
    {
        $vacancy = $this->vacancy->findPlayerMembers()->where('user_id', $id)->first();
        $vacancy->pivot->status = FindPlayerStatus::REJECTED;
        $vacancy->pivot->save();

        return Notification::make()
            ->title('Usuário recusado!')
            ->body('O usuário foi recusado com sucesso para a vaga.')
            ->success()
            ->send();
    }
}
