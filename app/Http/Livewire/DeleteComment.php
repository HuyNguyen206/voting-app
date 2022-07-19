<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class DeleteComment extends Component
{
    use AuthorizesRequests;
    protected $listeners = ['setDeleteComment'];
    public $commentId;
    public function render()
    {
        return view('livewire.delete-comment');
    }

    public function setDeleteComment($commentId)
    {
        $this->commentId = $commentId;
    }

    public function deleteComment()
    {
        abort_if(auth()->guest(), Response::HTTP_UNAUTHORIZED);
        $this->authorize('delete', $comment = Comment::findOrFail($this->commentId));
        $comment->delete();
        $this->emitTo(IdeaComments::class, 'updateIdea');
        $this->dispatchBrowserEvent('delete-comment');
    }
}
