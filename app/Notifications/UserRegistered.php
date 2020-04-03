<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
use Illuminate\Notifications\Messages\BroadcastMessage;
class UserRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $user;
    public $project_name;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->project_name = "User Created";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'created_user' => $this->user,
            'admin' => $notifiable,
            'notification_table' => [
                'project_name' => $this->project_name,
                'item' => $this->user->last_name . ", " . $this->user->first_name,
                'status' => 'For Approval'
            ],
            'notification_bell'=> [
                'header' => $this->project_name,
                'date' => $this->user->created_at
            ]
        ];
    }

    
/**
 * Get the broadcastable representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return BroadcastMessage
 */
public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        // 'created_user' => $this->user,
        // 'admin' => $notifiable,
        // 'notification_table' => [
        //     'project_name' => $this->project_name,
        //     'item' => $this->user->last_name . ", " . $this->user->first_name,
        //     'status' => 'For Approval'
        // ],
        // 'notification_bell'=> [
        //     'header' => $this->project_name,
        //     'date' => $this->user->created_at
        // ]
        'notification' => $notifiable->notifications()->latest()->first()
    ]);
}
}
