<?php

namespace App\Livewire\Teams\MyTeams\Setting;

use App\Models\Team;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Validation\Rule;

class AboutTeam extends Component
{
    public $team;


    public $name;
    public $description;
    public $site_url;
    public $discord_url;
    public $facebook_url;
    public $instagram_url;
    public $twitter_url;
    public $twitch_url;
    public $youtube_url;
    public $email;


    public function rules()
    {
        return [
            'site_url' => [
                'nullable',
                'url',
                Rule::unique('teams')->ignore($this->team->id)
            ],
            'discord_url' => [
                'nullable',
                'url',
                Rule::unique('teams')->ignore($this->team->id)
            ],
            'facebook_url' => [
                'nullable',
                'url',
                Rule::unique('teams')->ignore($this->team->id)
            ],
            'instagram_url' => [
                'nullable',
                'url',
                Rule::unique('teams')->ignore($this->team->id)
            ],
            'twitter_url' => [
                'nullable',
                'url',
                Rule::unique('teams')->ignore($this->team->id)
            ],
            'twitch_url' => [
                'nullable',
                'url',
                Rule::unique('teams')->ignore($this->team->id)
            ],
            'youtube_url' => [
                'nullable',
                'url',
                Rule::unique('teams')->ignore($this->team->id)
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('teams')->ignore($this->team->id)
            ],

        ];
    }

    public function mount(string $slug)
    {
        $this->team = Team::where("slug", $slug)->firstOrFail();
        $this->name = $this->team->name;
        $this->description = $this->team->description;
        $this->site_url = $this->team->site_url;
        $this->discord_url = $this->team->discord_url;
        $this->facebook_url = $this->team->facebook_url;
        $this->instagram_url = $this->team->instagram_url;
        $this->twitter_url = $this->team->twitter_url;
        $this->twitch_url = $this->team->twitch_url;
        $this->youtube_url = $this->team->youtube_url;
        $this->email = $this->team->email;
    }

    public function render()
    {
        return view('livewire.teams.my-teams.setting.about-team');
    }

    public function save()
    {
        $this->validate();

        $this->team->update([
            'name' => $this->name,
            'description' => $this->description,
            'site_url' => $this->site_url,
            'discord_url' => $this->discord_url,
            'facebook_url' => $this->facebook_url,
            'instagram_url' => $this->instagram_url,
            'twitter_url' => $this->twitter_url,
            'twitch_url' => $this->twitch_url,
            'youtube_url' => $this->youtube_url,
            'email' => $this->email,
        ]);

        $this->team->save();
    }
}
