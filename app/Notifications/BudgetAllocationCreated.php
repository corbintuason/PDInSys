<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\BudgetAllocation;


class BudgetAllocationCreated extends Notification
{
    use Queueable;

    public $budget;
    public $project_name;
    public $item_name;

    public function __construct(BudgetAllocation $budget)
    {
        $this->budget = $budget;
        $this->project_name = "BA";
        $this->item_name = "Budget Allocation";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            'created_budget' => $this->budget,
            'approver' => $notifiable,
            'link' => [
                "name" => 'budget_show',
                "id" => $this->budget->id
            ],
            'notification_table' => [
                'code' => "PMID" . '-' . $this->budget->code,
                'item' => $this->item_name,
                'status' => 'For Approval'
            ],
            'notification_bell' => [
                'header' => $this->project_name . '-' . $this->budget->code  . " " . "Opened",
                'date' => $this->budget->created_at
            ]
        ];
    }
}
