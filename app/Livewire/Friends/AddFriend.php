<?php

namespace App\Livewire\Friends;

use App\Enums\FriendStatus;
use App\Events\UpdateNotificationEvent;
use App\Models\Friend;
use App\Models\User;
use App\Notifications\FriendNotification;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddFriend extends Component
{
    public $user_id;
    public $text_button;

    public function mount(string|int $user_id, string $text_button = null)
    {
        $this->user_id = $user_id;
        $this->text_button = $text_button ?? 'Enviar solicitação';
    }

    public function render()
    {
        return view('livewire.friends.add-friend');
    }

    public function addFriend(string|int $user_id)
    {
        $userOrigin = Auth::user();
        $userDestination = User::find($user_id);

        $areFriends = Friend::where(function ($query) use ($userOrigin, $userDestination) {
            $query->where('user_origin', $userOrigin->id)
                ->where('user_destination', $userDestination->id);
        })
            ->orWhere(function ($query) use ($userOrigin, $userDestination) {
                $query->where('user_origin', $userDestination->id)
                    ->where('user_destination', $userOrigin->id);
            })
            ->exists();


        if (!$areFriends) {

            $friendData = Friend::create([
                'user_origin' => $userOrigin->id,
                'user_destination' => $userDestination->id,
                'status' => FriendStatus::PENDING->getName()
            ]);

            $userDestination->notify(new FriendNotification($friendData, $userOrigin));


            $this->dispatch('close-modal');
            $this->dispatch('reset-search');

            Notification::make()
                ->title('Pedido de amizade enviado!')
                ->body('Seu pedido de amizade foi enviado com sucesso.')
                ->success()
                ->send();


            return UpdateNotificationEvent::dispatch();
        }

        $this->dispatch('close-modal');
        $this->dispatch('reset-search');

        return Notification::make()
            ->title('Pedido de amizade já enviado!')
            ->body('Você já enviou um pedido de amizade para este usuário.')
            ->warning()
            ->send();
    }
}
