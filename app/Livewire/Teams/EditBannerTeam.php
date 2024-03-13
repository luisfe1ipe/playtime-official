<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class EditBannerTeam extends Component implements HasForms
{
    use InteractsWithForms;

    public $banner;
    public $team;

    public function mount(Team $team)
    {
        $this->team = $team;

        $this->banner = $team->banner;

        $this->form->fill([
            'banner' => $this->banner
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('banner')
                    ->image()
                    ->imageEditor(true)
                    ->panelLayout('integrated')
                    ->imagePreviewHeight('250')
                    ->panelAspectRatio('2:1')
                    ->required()
                    ->directory('teams/banners/')
            ]);
    }

    public function render()
    {
        return view('livewire.teams.edit-banner-team');
    }

    public function create()
    {
        $data = $this->form->getState();

        if (isset($data['banner'])) {
            $this->team->banner = $data['banner'];
            $this->team->save();
        }

        $this->dispatch('close-modal');
        $this->dispatch('saved');

        return Notification::make()
            ->title('Banner atualizado com sucesso!')
            ->success()
            ->send();
    }
}
