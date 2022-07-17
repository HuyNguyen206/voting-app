<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class EditComment extends Component
{
    use AuthorizesRequests;
    public $comment;
    public $body;
    protected $listeners = ['setEditComment'];

    protected function rules()
    {
        return [
            'body' => 'required|min:2',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function setEditComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);
        $this->body = $this->comment->body;
        $this->dispatchBrowserEvent('custom-show-edit-comment');
    }

    public function updateComment()
    {
        abort_if(auth()->guest(), Response::HTTP_FORBIDDEN);
        $this->authorize('update', $this->comment);
        $this->validate();
        $this->comment->update([
            'body' => $this->body
        ]);
        $this->emitTo(IdeaComment::class, 'updateIdea');
        $this->dispatchBrowserEvent('edit-comment');
    }

    public function render()
    {
        return view('livewire.edit-comment');
    }
}
