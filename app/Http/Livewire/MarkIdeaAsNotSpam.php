<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class MarkIdeaAsNotSpam extends Component
{
    use AuthorizesRequests;
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }
    public function render()
    {
        return view('livewire.mark-idea-as-not-spam');
    }

    public function markIdeaAsNotSpam()
    {
        $this->authorize('markAsNotSpam', $this->idea);
        $this->idea->update(['spam_reports' => 0]);
//        $this->emitTo(IdeaNotification::class, 'displayNotification', 'Idea was mark as not spam successfully!');
        $this->emitTo(IdeaShow::class, 'updateIdea');
        $this->dispatchBrowserEvent('mark-not-spam-idea');
    }
}
