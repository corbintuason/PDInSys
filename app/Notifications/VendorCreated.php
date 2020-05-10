<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Vendor;
use Illuminate\Notifications\Messages\BroadcastMessage;

class VendorCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $vendor;
    public $project_name;
    public $item_name;

    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
        $this->project_name = "VID";
        $this->item_name = "Vendor Accreditation";
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
            'created_vendor' => $this->vendor,
            'approver' => $notifiable,
            'link' => [
                "name" => 'vendor_show',
                "id" => $this->vendor->id
            ],
            'notification_table' => [
                'code' => "VID" . '-' . $this->vendor->code,
                'item' => $this->item_name,
                'status' => 'For Approval'
            ],
            'notification_bell' => [
                'header' => $this->project_name . '-' . $this->vendor->code . " " . "Created",
                'date' => $this->vendor->created_at
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
