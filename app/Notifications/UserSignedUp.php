<?php

namespace App\Notifications;

use App\Models\FindPlayer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSignedUp extends Notification
{
    use Queueable;

    private FindPlayer $find_player;
    private User $registered_user;

    /**
     * Create a new notification instance.
     */
    public function __construct(FindPlayer $find_player, User $registered_user)
    {
        $this->find_player = $find_player;
        $this->registered_user = $registered_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'find_player' => $this->find_player,
            'user_registered' => $this->registered_user
        ];
    }

    /**
     * Get the notification's database type.
     *
     * @return string
     */
    public function databaseType(object $notifiable): string
    {
        return 'user-registered-vacancy';
    }
}
