<?php

namespace App\Livewire\FindPlayer;

use App\Enums\FindPlayerStatus;
use App\Events\UpdateNotificationEvent;
use App\Events\UpdateVacancyRegistrationsEvent;
use App\Models\FindPlayer;
use App\Notifications\UserAcceptOrRefuseVacancyNotification;
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
    public $search;
    public $selectedOrder;

    public function mount($id)
    {
        $this->vacancy = FindPlayer::with(['user', 'character', 'position', 'rankMax', 'rankMin', 'game'])->find($id);

        if (!$this->vacancy) {
            return abort('404');
        }
    }

    #[On(['echo:update-vacancy-registrations,UpdateVacancyRegistrationsEvent', 'refreshComponent'])]
    public function render()
    {
        $vacancy = $this->vacancy->findPlayerMembers();

        if ($this->selectedOrder) {
            $vacancy->orderBy('pivot_created_at', $this->selectedOrder);
        }

        if ($this->search) {
            $vacancy->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nick', 'like', '%' . $this->search . '%');
            });
        }

        $registeredUsers = $vacancy->paginate(6);

        return view('livewire.find-player.show-find-player', [
            'registeredUsers' => $registeredUsers
        ]);
    }

    #[On('echo:update-vacancy-registrations,UpdateVacancyRegistrationsEvent')]
    public function resetPagination()
    {
        $this->resetPage();
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

            $this->vacancy->user->notify(new UserSignedUp($this->vacancy, $user));

            UpdateNotificationEvent::dispatch();
            UpdateVacancyRegistrationsEvent::dispatch();

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

            UpdateVacancyRegistrationsEvent::dispatch();

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
        $this->authorize('isAuthor', $this->vacancy);

        $vacancy = $this->vacancy->findPlayerMembers()->where('user_id', $id)->first();
        if ($vacancy->pivot->status == FindPlayerStatus::ACCEPTED->value) {
            return Notification::make()
                ->title('Usuário já foi aceito anteriormente!')
                ->warning()
                ->send();
        }

        $vacancy->pivot->status = FindPlayerStatus::ACCEPTED;
        $vacancy->pivot->save();

        $vacancy->notify(new UserAcceptOrRefuseVacancyNotification($this->vacancy, $this->vacancy->user));

        UpdateNotificationEvent::dispatch();
    }

    public function refuseUser($id)
    {
        $this->authorize('isAuthor', $this->vacancy);

        $vacancy = $this->vacancy->findPlayerMembers()->where('user_id', $id)->first();

        if ($vacancy->pivot->status == FindPlayerStatus::REJECTED->value) {
            return Notification::make()
                ->title('Usuário já foi rejeitado anteriormente!')
                ->warning()
                ->send();
        }

        $vacancy->pivot->status = FindPlayerStatus::REJECTED;
        $vacancy->pivot->save();

        $vacancy->notify(new UserAcceptOrRefuseVacancyNotification($this->vacancy, $this->vacancy->user, '<span style="color:#f43f5e">recusou</span> sua inscrição na vaga'));

        UpdateNotificationEvent::dispatch();
    }
}
