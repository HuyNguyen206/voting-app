<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    protected $listeners = ['updateStatusFilter' => 'updateIdeas'];
    public $status;
    protected $queryString = ['status'];
    public function render()
    {
        $ideas = $this->getIdeas();
        return view('livewire.ideas-index', compact('ideas'));
    }

    public function getIdeas()
    {
        $userId = auth()->id();
        $status = $this->status;
        return Idea::with(['user', 'category', 'status'])
            ->withCount('votedUsers as votedUsersCount')
            ->addSelect([
                'isVoted' => Vote::select('id')->whereColumn('idea_id', 'ideas.id')->whereUserId($userId)
            ])
            ->when($status && $status !== 'all', function (Builder $builder) use($status) {
                $builder->whereHas('status', function (Builder $builder) use($status) {
                    $builder->where('name', Str::of($status)->headline());
                });
            })
            ->latest()
            ->paginate(Idea::PAGINATION_COUNT);
    }

    public function updateIdeas($status)
    {
        $this->status = $status;
//        return $this->redirectRoute('ideas.index', compact('status'));
    }
}
