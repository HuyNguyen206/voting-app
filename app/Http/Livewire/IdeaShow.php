<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\Vote;
use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    use Vote;
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
