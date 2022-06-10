<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\Vote;
use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    use Vote;
    public $idea;

    public function mount($idea)
    {
        $this->idea = $idea;
    }
    public function render()
    {
        return view('livewire.idea-index');
    }

}
