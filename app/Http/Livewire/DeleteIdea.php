<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class DeleteIdea extends Component
{
    use AuthorizesRequests;
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }
    public function render()
    {
        return view('livewire.delete-idea');
    }

    public function deleteIdea()
    {
        abort_if(auth()->guest(), Response::HTTP_UNAUTHORIZED);
        $this->authorize('delete', $this->idea);
        $this->idea->votedUsers()->detach();
        $this->idea->delete();
        session()->flash('success_message', 'Your idea was deleted successfully!');
        $this->redirect(route('ideas.index'));
    }
}
