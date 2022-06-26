<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class EditIdea extends Component
{
    public $idea;
//    protected $listeners = ['showIdeaEditModal'];
    public function render()
    {
        return view('livewire.edit-idea');
    }

//    public function showIdeaEditModal(Idea $idea)
//    {
//        $this->idea = $idea;
//        $this->dispatchBrowserEvent('show-idea-edit-modal');
//    }
}
