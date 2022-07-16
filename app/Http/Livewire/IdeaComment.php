<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IdeaComment extends Component
{
    public $comment;

    public function render()
    {
        return view('livewire.idea-comment');
    }
}
