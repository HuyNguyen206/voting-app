<?php

namespace App\Notifications;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;

class IdeaUpdatedNotification extends Notification
{
    use Queueable;
    private $idea;
    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Idea $idea, User $user)
    {
        //
        \logger('$idea '.json_encode($idea));
        $this->idea = $idea;
        $this->message = "The idea {$idea->title} was updated by {$user->name}";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line("$this->message")
                    ->action('Go to idea',route('ideas.show', $this->idea->slug))
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
            'message' => $this->message
        ];
    }
}
