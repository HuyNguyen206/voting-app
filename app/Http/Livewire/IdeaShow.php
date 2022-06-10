<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    public $idea;
    public $isVoted;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->isVoted =$idea->isVotedByUser(auth()->id());
    }
    public function render()
    {
        return view('livewire.idea-show');
    }
}
