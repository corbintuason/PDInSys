<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ItemNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $item;
    public $module;
    public $show_route;
    public function __construct($item, $module, $show_route)
    {
        $this->item = $item;
        $this->module = $module;
        $this->show_route = $show_route;
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
            'item' => $this->item,
            'approver' => $notifiable,
            'link' => [
                "name" => $this->show_route,
                "id" => $this->item->id
            ],
            'notification_table' => [
                'code' => $this->item->code,
                'item' => $this->module,
                'status' => $this->item->status
            ],
            'notification_bell' => [
                'header' => $this->item->code,
                'body' => $this->module,
                'date' => $this->item->created_at
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
