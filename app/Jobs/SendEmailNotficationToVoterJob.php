<?php

namespace App\Jobs;

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
    public $idea;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Idea $idea, User $user)
    {
        //
        $this->idea = $idea;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->idea->votedUsers()->select('name', 'email')
            ->chunk(100, function ($voters) {
                Notification::send($voters, new IdeaUpdatedNotification($this->idea, $this->user));
            });
    }
}
