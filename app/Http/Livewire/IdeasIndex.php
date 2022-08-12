<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Vote;
use App\Providers\RouteServiceProvider;
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
        $this->setCurrentUrlPageToIntended($ideas);

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
            ->withCount('comments as commentsCount')
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
                   case 'most_spam_idea':
                        $builder->where('spam_reports', '>=', 1)
                                ->orderByDesc('spam_reports');
                        break;
                   case 'top_voted':
                        $builder->orderByDesc('votedUsersCount');
                        break;
                   case 'most_spam_comment':
                        $builder->whereHas('comments', function (Builder $builder) {
                            $builder->where('spam_reports', '>=', 1)
                                ->orderByDesc('spam_reports');
                        })->withCount(['comments as commentCount' => function (Builder $builder) {
                            $builder->where('spam_reports', '>=', 1);
                        }])->orderByDesc('commentCount');
                        break;
                }
            });
//        if($filter === 'top_voted') {
//            $mainQuery->orderByDesc('votedUsersCount');
//        } else {
            $mainQuery->latest();
//        }
        $pagination = $mainQuery->paginate()->withQueryString();
        $this->setCurrentUrlPageToIntended($pagination);
        return $pagination;
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

    /**
     * @param $mainQuery
     * @return string
     */
    public function setCurrentUrlPageToIntended($pagination)
    {
        $currentPage = $pagination->currentPage();
        $routeUrl = route('ideas.index', ['page' => $currentPage, 'status' => $this->status]);
//        $currentPageUrl = str_replace("page=$previousPage", "page=$currentPage", url()->previous());
        redirect()->setIntendedUrl($routeUrl);
    }

}
