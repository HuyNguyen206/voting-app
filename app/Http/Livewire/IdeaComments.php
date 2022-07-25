<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

class IdeaComments extends Component
{
    use WithPagination;
    protected $listeners = ['updateIdea'];
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }
    public function render()
    {
        $comments = $this->idea->comments()->with(['user', 'status'])->paginate()->withQueryString();
        return view('livewire.idea-comments', compact('comments'));
    }

    public function updateIdea()
    {
        $this->idea->refresh();
        $lastPage = $this->idea->comments()->paginate()->lastPage();
        $this->gotoPage($lastPage);
    }
}
