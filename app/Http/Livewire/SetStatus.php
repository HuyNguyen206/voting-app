<?php

namespace App\Http\Livewire;

use App\Jobs\SendEmailNotficationToVoterJob;
use App\Models\Idea;
use App\Models\Status;
use App\Notifications\IdeaUpdatedNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class SetStatus extends Component {

    public $statuses;
    public $idea;
    public $status;
    public $description;
    public $notifyUser;

    public function mount(Idea $idea)
    {
        $this->statuses = Status::all();
        $this->status = $idea->status_id;
        $this->idea = $idea;
    }

    public function render()
    {
        return view('livewire.set-status');
    }

    public function updateIdea()
    {
        if ($this->idea->status_id === (int) $this->status) {
            $this->dispatchBrowserEvent('custom-show-notification',
                ['message' => "This idea already in the status {$this->idea->status->name}",'is_success' => false]);
            return;
        }
        $this->idea->update([
            'status_id' => $this->status,
        ]);
        $this->emitTo(IdeaShow::class, 'updateIdea');
        $user = auth()->user();
        $comment = $this->idea->comments()->create([
            'user_id' => $user->id,
            'body' => $this->description ?? 'No comment was added',
            'is_update_status' => 1,
            'status_id' => $this->status,
        ]);
        if ($this->notifyUser) {
            dispatch(new SendEmailNotficationToVoterJob($comment->load(['user', 'idea'])));
        }
        $this->emitTo(IdeaComments::class, 'updateIdea');
        $this->dispatchBrowserEvent('idea-updated');
    }
}
