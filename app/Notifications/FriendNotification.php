<?php

namespace App\Notifications;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendNotification extends Notification
{
    use Queueable;
    private Friend $friend;
    private User $userOrigin;
    private string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Friend $friend, User $userOrigin, string $message = null)
    {
        $this->friend = $friend;
        $this->userOrigin = $userOrigin;
        $this->message = $message ?? "Você recebeu um novo pedido de amizade";
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
            'friend' => $this->friend,
            'userOrigin' => $this->userOrigin
        ];
    }

    /**
     * Get the notification's database type.
     *
     * @return string
     */
    public function databaseType(object $notifiable): string
    {
        return 'friend-notification';
    }
}
