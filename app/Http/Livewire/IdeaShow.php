<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\Vote;
use App\Models\Idea;
use App\Models\Status;
use Livewire\Component;

class IdeaShow extends Component
{
    use Vote;

    public $idea;
    public $isVoted;
    protected $listeners = ['updateIdea'];

    public function mount(Idea $idea)
    {
        redirect()->setIntendedUrl(url()->current());
        $this->idea = $idea;
        $this->idea->loadCount(['votedUsers as votedUsersCount']);
        $this->isVoted = $idea->isVotedByUser(auth()->id());
        $this->statuses = Status::all();
    }

    public function render()
    {
        return view('livewire.idea-show');
    }

    public function updateIdea()
    {
        $this->idea->refresh();
    }

//    public function showIdeaEditModal()
//    {
//        $this->emitTo(EditIdea::class, 'showIdeaEditModal', ['idea' => $this->idea]);
//    }
}
