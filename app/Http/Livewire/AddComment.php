<?php

namespace App\Http\Livewire;

use App\Notifications\IdeaUpdatedNotification;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class AddComment extends Component {

    public $idea;
    public $body;

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

    public function render()
    {
        return view('livewire.add-comment');
    }

    public function addComment()
    {
        abort_if(auth()->guest(), Response::HTTP_FORBIDDEN);
        $this->validate();
        $comment = $this->idea->comments()->create([
            'body' => $this->body,
            'user_id' => auth()->id()
        ]);
        $this->emitTo(IdeaShow::class, 'updateIdea');
        $this->emitTo(IdeaComments::class, 'updateIdea');
        $this->dispatchBrowserEvent('add-comment');
        $this->reset('body');
//        $this->idea->user->notify(new IdeaUpdatedNotification($comment, session('page_can_have_new_comment')));
        $this->idea->user->notify(new IdeaUpdatedNotification($comment));
    }
}
