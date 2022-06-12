<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Status;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status = 'all';
    public $category = null;
    protected $queryString = ['status', 'category'];
    protected $listeners = ['updateCategory'];

    public function mount()
    {
        if (Route::currentRouteName() === 'ideas.show') {
            $this->status = null;
        }
    }
    public function render()
    {
        $statusCount = [];
        Status::query()->withCount(['ideas as count' => function ($query) {
            if ($this->category) {
                $categoryId = Category::whereSlug($this->category)->first()->id;
                $query->where('category_id', $categoryId);
            }
        }])->get()->each(function ($status) use(&$statusCount){
            $statusCount[$status->name] = $status->count;
        });
        $statusCount['All'] = array_sum($statusCount);
        return view('livewire.status-filters', compact('statusCount'));
    }

    public function updateStatusFilter($status, $isShowPage = false)
    {
        if ($isShowPage) {
            return $this->redirectRoute('ideas.index', compact('status'));
        }
        $this->emit('updateStatusFilter', $status);
        $this->status = $status;
    }

    public function updateCategory($category)
    {
      $this->category = $category;
    }
}
