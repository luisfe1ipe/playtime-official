<?php

namespace App\Http\Controllers;

use App\Models\InviteTeamUser;
use App\Models\Team;
use Illuminate\Http\Request;

class InviteMemberTeamController extends Controller
{
    public function accept(string $id)
    {
        $invite = InviteTeamUser::find($id);
        
        abort_if(!$invite, 404);

        $team = Team::find($invite->team_id);

        $team->members()->attach($invite->user_id);

        return redirect()->route('teams.index');
    }
}
