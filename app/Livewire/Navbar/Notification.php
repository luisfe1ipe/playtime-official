<?php

namespace App\Livewire\Navbar;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Notification extends Component
{
    public $viewNotifications = 'new';

    #[On(['echo:update-notification,UpdateNotificationEvent', 'delete-notifications'])]
    public function render()
    {
        if (Auth::user()) {
            $notifications = Auth::user()->notifications->where('read_at', null);
            $readNotifications = Auth::user()->notifications->where('read_at', '!=', null);
        }

        return view('livewire.navbar.notification', [
            'notifications' => $notifications,
            'readNotifications' => $readNotifications
        ]);
    }

    public function readNotification($id)
    {
        $user = Auth::user();

        $not = $user->notifications->where('id', $id)->first();
        $not->markAsRead();
    }

    public function readAllNotifications()
    {
        $user = Auth::user();
        $user->notifications->markAsRead();
    }

    public function deleteNotification($id)
    {
        $user = Auth::user();

        $not = $user->notifications->where('id', $id)->first();
        $not->delete();

        $this->dispatch('delete-notifications');
    }

    public function deleteAllNotifications()
    {
        $user = Auth::user();

        $nots = $user->notifications->where('read_at', '!=', null);

        foreach ($nots as $not) {
            $not->delete();
        }

        $this->dispatch('delete-notifications');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
