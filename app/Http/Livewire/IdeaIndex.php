<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\Vote;
use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    use Vote;
    public $idea;
    public $isVoted;

    public function mount($idea)
    {
        $this->idea = $idea;
        $this->isVoted =$idea->isVoted;
    }
    public function render()
    {
        return view('livewire.idea-index');
    }

}
