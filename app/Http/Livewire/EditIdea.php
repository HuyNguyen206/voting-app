<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class EditIdea extends Component {

    use AuthorizesRequests;
    public $idea;
    public $title;
    public $category;
    public $description;

//    protected $listeners = ['showIdeaEditModal'];
    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->title = $idea->title;
        $this->category = $idea->category_id;
        $this->description = $idea->description;
    }

    protected function rules()
    {
        return [
            'title' => 'required|min:2',
            'category' => ['required', Rule::exists('categories', 'id')],
            'description' => 'min:5',
        ];
    }

    public function render()
    {
//        dd(123);
        $categories = Category::all();
        return view('livewire.edit-idea', compact('categories'));
    }

    public function updateIdea()
    {
        abort_if(auth()->guest(), Response::HTTP_UNAUTHORIZED);
        $this->authorize('update', $this->idea);
        $this->validate();
        $this->idea->update([
            'title' => $this->title,
            'category_id' => $this->category,
            'description' => $this->description
        ]);
        $this->emitTo(IdeaShow::class, 'updateIdea');
        $this->dispatchBrowserEvent('update-idea');

//            return redirect()->route('ideas.index');
    }

//    public function showIdeaEditModal(Idea $idea)
//    {
//        $this->idea = $idea;
//        $this->dispatchBrowserEvent('show-idea-edit-modal');
//    }
}
