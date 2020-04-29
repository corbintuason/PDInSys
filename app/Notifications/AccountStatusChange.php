<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Account;
use Illuminate\Notifications\Messages\BroadcastMessage;

class AccountStatusChange extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $account;
    public $project_name;

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->project_name = "Account Status Updated";
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
            'created_account' => $this->account,
            'approver' => $notifiable,
            'link' => [
                "name" => 'account_show',
                "id" => $this->account->id
            ],
            'notification_table' => [
                'project_name' => $this->project_name,
                'item' => $this->account->registered_name,
                'status' => $this->account->status,
            ],
            'notification_bell' => [
                'header' => $this->project_name,
                'date' => $this->account->created_at
            ]
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notification' => $notifiable->notifications()->latest()->first()
        ]);
    }
}
