<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaComments extends Component
{
    protected $listeners = ['updateIdea'];
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea;
    }
    public function render()
    {
        return view('livewire.idea-comments');
    }

    public function updateIdea()
    {
        $this->idea->refresh();
    }
}
