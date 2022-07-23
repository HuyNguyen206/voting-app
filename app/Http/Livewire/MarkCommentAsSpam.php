<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class MarkCommentAsSpam extends Component
{
    use AuthorizesRequests;
    protected $listeners = ['setMarkCommentAsSpam'];
    public $commentId;

    public function setMarkCommentAsSpam($commentId)
    {
        $this->commentId = $commentId;
    }

    public function markCommentAsSpam()
    {
        abort_if(auth()->guest(), Response::HTTP_FORBIDDEN);
        $comment = Comment::findOrFail($this->commentId);
        $comment->increment('spam_reports');
//        $this->emitTo(IdeaComments::class, 'updateIdea');
        $this->emitTo(IdeaComment::class, 'updateComment');
        $this->emitTo(IdeaShow::class, 'updateIdea');
        $this->dispatchBrowserEvent('mark-comment-as-spam');
    }
    public function render()
    {
        return view('livewire.mark-comment-as-spam');
    }
}
