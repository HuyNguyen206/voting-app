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
        $this->idea->update([
            'status_id' => $this->status,
        ]);
        $this->emitTo(IdeaShow::class, 'updateIdea');
        $user = auth()->user();
        if ($this->notifyUser) {
               dispatch(new SendEmailNotficationToVoterJob($this->idea, $user));
        }
        $this->idea->comments()->create([
            'user_id' => $user->id,
            'body' => $this->description ?? 'No comment was added',
            'is_update_status' => 1,
            'status_id' => $this->status,
        ]);
        $this->emitTo(IdeaComments::class, 'updateIdea');
        $this->dispatchBrowserEvent('idea-updated');
    }
}
