<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Project;
use App\User;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ProjectCoreEmployeeAssigned extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $user;
    public $project;
    public $project_name;

    public function __construct(User $user, Project $project)
    {
        $this->user = $user;
        $this->project = $project;
        $this->project_name = "You have been assigned to a project";
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
            'link' => [
                "name" => 'project_show',
                "id" => $this->project->id
            ],
            'notification_table' => [
                'project_name' => $this->project_name,
                'item' => $this->project->name,
                'status' => $this->project->status
            ],
            'notification_bell'=> [
                'header' => $this->project_name,
                'date' => $this->project->created_at
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
