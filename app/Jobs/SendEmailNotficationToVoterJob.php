<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use App\Notifications\IdeaUpdatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendEmailNotficationToVoterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Comment
     */
    private $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment->idea->votedUsers()->select('name', 'email')
            ->chunk(100, function ($voters) {
                Notification::send($voters, new IdeaUpdatedNotification($this->comment));
            });
    }
}
