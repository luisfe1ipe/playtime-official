<?php

namespace App\Livewire\Notification;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ListNotifications extends Component
{
    #[On(['echo:registered-user-find-player,UserSignedUpEvent', 'delete-notifications'])]
    public function render()
    {
        $notifications = Auth::user()->notifications;

        return view('livewire.notification.list-notifications', [
            'notifications' => $notifications
        ]);
    }

    public function readNotification($id)
    {
        $user = Auth::user();

        $not = $user->notifications->where('id', $id)->first();
        $not->read_at = now();
        $not->save();
    }

    public function deleteNotification($id)
    {
        $user = Auth::user();

        $not = $user->notifications->where('id', $id)->first();
        $not->delete();

        $this->dispatch('delete-notifications');
    }
}
