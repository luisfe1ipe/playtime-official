<?php

namespace App\Notifications;

use App\Models\FindPlayer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAcceptOrRefuseVacancyNotification extends Notification
{
    use Queueable;

    private FindPlayer $find_player;
    private User $find_player_creator_user;
    private string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(FindPlayer $find_player, User $find_player_creator_user, string $message = '<span style="color:#22c55e">aceitou</span> sua inscrição na vaga.')
    {
        $this->find_player = $find_player;
        $this->find_player_creator_user = $find_player_creator_user;
        $this->message = $message;
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
            'message' => $this->message,
            'find_player' => $this->find_player,
            'find_player_creator_user' => $this->find_player_creator_user
        ];
    }
    /**
     * Get the notification's database type.
     *
     * @return string
     */
    public function databaseType(object $notifiable): string
    {
        return 'user-accept-or-refuse-vacancy';
    }
}
