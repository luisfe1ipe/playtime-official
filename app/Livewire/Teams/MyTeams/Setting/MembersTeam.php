<?php

namespace App\Livewire\Teams\MyTeams\Setting;

use App\Mail\InvitingMemberTeam;
use App\Models\InviteTeamUser;
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
        $this->team = Team::where('slug', $slug)->with(['user', 'members'])->first();
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
        $user_id = User::select('id', 'email')->where('email', $email)->first();

        $invite = InviteTeamUser::create([
            'user_id' => $user_id->id,
            'team_id' => $this->team->id,
        ]);

        Mail::to($email)->send(
            new InvitingMemberTeam(
                teamName: $this->team->name,
                teamSlug: $this->team->slug,
                teamLeaderNick: $this->team->user->nick,
                inviteId: $invite->id
            )
        );

        $this->dispatch('close-modal');
        $this->reset('search');

        Notification::make()
            ->title('Convite enviado com sucesso.')
            ->success()
            ->send();
    }

    public function removeMember(string|int $id)
    {
        $this->team->members()->detach($id);

        Notification::make()
            ->title('Membro removido com sucesso!')
            ->success()
            ->send();
    }

    public function makeLeader(string|int $id)
    {
        $oldLeader = $this->team->user_id;
        $this->team->user_id = $id;
        $this->team->save();
        $this->team->members()->attach($oldLeader);
        $this->team->members()->detach($id);


        Notification::make()
            ->title('Líder alterado com sucesso!')
            ->success()
            ->send();
    }
}
