<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class MarkCommentAsNotSpam extends Component
{
    use AuthorizesRequests;
    protected $listeners = ['setMarkCommentAsNotSpam'];
    public $commentId;

    public function setMarkCommentAsNotSpam($commentId)
    {
        $this->commentId = $commentId;
    }

    public function markCommentAsNotSpam()
    {
        abort_if(auth()->guest(), Response::HTTP_UNAUTHORIZED);
        $comment = Comment::findOrFail($this->commentId);
        $comment->update(['spam_reports' => 0]);
//        $this->emitTo(IdeaComments::class, 'updateIdea');
        $this->emitTo(IdeaComment::class, 'updateComment');
        $this->emitTo(IdeaShow::class, 'updateIdea');
        $this->dispatchBrowserEvent('mark-comment-as-not-spam');
    }

    public function render()
    {
        return view('livewire.mark-comment-as-not-spam');
    }
}
