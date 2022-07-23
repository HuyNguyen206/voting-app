<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IdeaComment extends Component
{
    public $comment;
    public $idea;
    protected $listeners = ['updateIdea', 'updateComment'];

    public function render()
    {
        return view('livewire.idea-comment');
    }

    public function updateIdea()
    {
        $this->idea->refresh();
    }

    public function updateComment()
    {
        $this->comment->refresh();
    }
}
