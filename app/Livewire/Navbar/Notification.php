<?php

namespace App\Livewire\Navbar;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Notification extends Component
{
    public $viewNotifications = 'new';

    #[On('delete-notifications')]
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
        $not->read_at = now();
        $not->save();
    }

    public function readAllNotifications()
    {
        $user = Auth::user();

        foreach ($user->notifications as $not) {
            $not->read_at = now();
            $not->save();
        }
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
}
