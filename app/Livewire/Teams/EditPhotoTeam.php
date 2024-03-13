<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Notifications\Notification;

class EditPhotoTeam extends Component implements HasForms
{
    use InteractsWithForms;


    public $image;
    public $team;

    public function mount(Team $team): void
    {
        $this->team = $team;

        $this->image = $team->image;

        $this->form->fill([
            'image' => $this->image
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->image()
                    ->imageEditor(true)
                    ->panelLayout('circle')
                    ->required()
                    ->directory('teams/images/')
            ]);
    }

    public function render()
    {
        return view('livewire.teams.edit-photo-team');
    }

    public function create()
    {
        $data = $this->form->getState();

        if (isset($data['image'])) {
            // Salva a nova foto do usuário
            $this->team->image = $data['image'];
            $this->team->save();
        }

        $this->dispatch('close-modal');
        $this->dispatch('saved');

        return Notification::make()
            ->title('Foto atualizada com sucesso!')
            ->success()
            ->send();
    }
}
