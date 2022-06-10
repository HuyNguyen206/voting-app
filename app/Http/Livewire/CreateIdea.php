<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class CreateIdea extends Component
{
    public $title;
    public $category;
    public $description;

    protected function rules()
    {
       return [
           'title' => 'required|min:2',
           'category' => ['required', Rule::exists('categories', 'id')],
           'description' => 'min:5'
       ];
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.create-idea', compact('categories'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createIdea()
    {
        if(auth()->check()) {
            $this->validate();

            Idea::create([
                'title' => $this->title,
                'category_id' => $this->category,
                'user_id' => auth()->id(),
                'status_id' => Status::whereName('Open')->first('id')->id,
                'description' => $this->description
            ]);
            session()->flash('success_message', 'Your idea was created success');
            $this->reset();
            return redirect()->route('ideas.index');
//            return redirect()->route('ideas.index');
        }
        abort(Response::HTTP_UNAUTHORIZED, 'Please login');
    }
}