<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class MarkIdeaAsSpam extends Component
{
    use AuthorizesRequests;
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }
    public function render()
    {
        return view('livewire.mark-idea-as-spam');
    }

    public function markIdeaAsSpam()
    {
        $this->authorize('markAsSpam', $this->idea);
        $this->idea->increment('spam_reports');
        $this->emitTo(IdeaShow::class, 'updateIdea');
        $this->dispatchBrowserEvent('mark-idea');
    }
}
