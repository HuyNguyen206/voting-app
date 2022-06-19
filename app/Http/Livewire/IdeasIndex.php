<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    protected $listeners = ['updateStatusFilter' => 'updateIdeas'];
    public $status, $category = null, $filter, $search;
    protected $queryString = ['status', 'category', 'filter', 'search'];
    public function render()
    {
        $categories = Category::all();
        $ideas = $this->getIdeas($categories);
        return view('livewire.ideas-index', compact('ideas', 'categories'));
    }

    public function mount()
    {
        if ($this->shouldRedirectToLoginPage()) {
            return redirect()->route('login');
        }
    }

    public function getIdeas($categories)
    {
        $user = auth()->user();
        $status = $this->status;
        $mainQuery = Idea::with(['user', 'category', 'status'])
            ->withCount('votedUsers as votedUsersCount')
            ->addSelect([
                'isVoted' => Vote::select('id')->whereColumn('idea_id', 'ideas.id')->whereUserId(optional($user)->id)
            ])
            ->when($status && $status !== 'all', function (Builder $builder) use ($status) {
                $statusId = Status::whereName(Str::headline($status))->first()->id;
                $builder->where('status_id', $statusId);
            })
            ->when($this->category, function (Builder $builder) use ($categories) {
                $builder->where('category_id', $categories->pluck('id', 'slug')->get($this->category));
            })
            ->when($this->search, function (Builder $builder) use ($categories) {
                $builder->where('title', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%");
            })
            ->when($filter = $this->filter, function (Builder $builder) use ($filter, $user) {
                switch ($filter) {
                    case 'my_ideas':
                        if ($user) {
                            $builder->whereBelongsTo($user);
                        }
                        break;
                }
            });
        if($filter === 'top_voted') {
            $mainQuery->orderByDesc('votedUsersCount');
        } else {
            $mainQuery->latest();
        }

        return $mainQuery->paginate(Idea::PAGINATION_COUNT);
    }

    public function updateIdeas($status)
    {
        $this->status = $status;
        $this->resetPage();
//        Session::put('status', $this->status);
//        return $this->redirectRoute('ideas.index', compact('status'));
    }

    public function updatedCategory()
    {
        $this->emit('updateCategory', $this->category);
        $this->resetPage();
//        Session::put('category', $this->category);
    }

    public function updatedSearch()
    {
        $this->resetPage();
//        Session::put('search', $this->search);
    }

    public function updatedFilter()
    {
        if ($this->shouldRedirectToLoginPage()) {
            return $this->redirect(route('login'));
        }
        $this->resetPage();
//        Session::put('filter', $this->filter);
    }

    private function shouldRedirectToLoginPage()
    {
      return auth()->guest() && $this->filter === 'my_ideas';
    }

}
