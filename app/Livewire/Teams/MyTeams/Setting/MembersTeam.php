<?php

namespace App\Livewire\Teams\MyTeams\Setting;

use App\Mail\InvitingMemberTeam;
use App\Models\Team;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;

class MembersTeam extends Component
{
    public $team;
    public $search = '';

    public function mount(string $slug)
    {
        $this->team = Team::where('slug', $slug)->with('user')->first();
    }


    public function render()
    {
        $users = [];
        if ($this->search) {
            $users = User::select('id', 'nick', 'email', 'photo')->where('nick', 'like', '%' . $this->search . '%')->get();
        }

        return view('livewire.teams.my-teams.setting.members-team', [
            'users' => $users,
        ])
            ->title('Membros ' . $this->team->name . ' - PlayTime');
    }

    public function invite(string $email)
    {
        Mail::to($email)->send(
            new InvitingMemberTeam(
                teamName: $this->team->name,
                teamSlug: $this->team->slug,
                teamLeaderNick: $this->team->user->nick
            )
        );

        $this->dispatch('close-modal');

        Notification::make()
            ->title('Convite enviado com sucesso.')
            ->success()
            ->send();
    }
}
