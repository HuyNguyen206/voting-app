<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Support\Facades\Session;
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
//        if ($comments->count() < Comment::PAGE_PAGINATION) {
//            $pageCanHasNewComment = $comments->currentPage();
//        } else {
//            $pageCanHasNewComment = $comments->currentPage() + 1;
//        }
//        Session::put('page_can_have_new_comment', $pageCanHasNewComment);
        return view('livewire.idea-comments', compact('comments'));
    }

    public function updateIdea()
    {
        $this->idea->refresh();
        $lastPage = $this->idea->comments()->paginate()->lastPage();
        $this->gotoPage($lastPage);
    }
}
