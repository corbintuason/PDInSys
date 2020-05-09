<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mandate;
use Illuminate\Notifications\Messages\BroadcastMessage;

class MandateCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $mandate;
    public $project_name;
    public $item_name;

    public function __construct(Mandate $mandate)
    {
        $this->mandate = $mandate;
        $this->project_name = "PMID";
        $this->item_name = "Mandate Module";
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
            'created_mandate' => $this->mandate,
            'approver' => $notifiable,
            'link' => [
                "name" => 'mandate_show',
                "id" => $this->mandate->id
            ],
            'notification_table' => [
                'code' => "PMID" . '-' . $this->mandate->code,
                'item' => $this->item_name,
                'status' => 'For Approval'
            ],
            'notification_bell' => [
                'header' => $this->project_name . '-' . $this->mandate->code  . " " . "Created",
                'date' => $this->mandate->created_at
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
