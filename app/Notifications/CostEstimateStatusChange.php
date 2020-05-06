<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\CostEstimate;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CostEstimateStatusChange extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

     public $cost_estimate;
     public $project_name;

    public function __construct(CostEstimate $cost_estimate)
    {
     $this->cost_estimate = $cost_estimate;
     $this->project_name = "Cost Estimate Updated"; 
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
            'item' => $this->cost_estimate,
            'approver' => $notifiable,
            'link' => [
                "name" => 'cost_estimate_show',
                "id" => $this->cost_estimate->project->id
            ],
            'notification_table' => [
                'code' => $this->cost_estimate->code,
                'item' => $this->project_name,
                'status' => $this->cost_estimate->status
            ],
            'notification_bell'=> [
                'header' => $this->cost_estimate->code .": " . $this->project_name,
                'date' => $this->cost_estimate->created_at
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
