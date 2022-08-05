<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Monolog\Logger;

class IdeaUpdatedNotification extends Notification
{
    use Queueable;
    public $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
            ->subject('Voting app: A comment was posted on your idea')
            ->markdown('mails.idea-updated', [
                'comment' => $this->comment
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $commenter = $this->comment->user;
        $commenterName = Str::ucfirst($commenter->name);
        $body = htmlspecialchars($this->comment->body) ;
        $message = "<span class='font-semibold'>$commenterName</span> comment on <span class='font-semibold'>{$this->comment->idea->title}</span>:
                                                      <span>$body</span>";
        return [
            'message' => $message,
            'commenterAvatar' => $commenter->avatar(),
            'linkToIdea' => route('ideas.show', $this->comment->idea->slug)
        ];
    }
}
