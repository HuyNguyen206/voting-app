<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status = 'all';
    protected $queryString = ['status'];

    public function mount()
    {
        if (Route::currentRouteName() === 'ideas.show') {
            $this->status = null;
        }
    }
    public function render()
    {
        $statusCount = [];
        Status::withCount('ideas as count')->get()->each(function ($status) use(&$statusCount){
            $statusCount[$status->name] = $status->count;
        });
        $statusCount['All'] = array_sum($statusCount);
        return view('livewire.status-filters', compact('statusCount'));
    }

    public function updateStatusFilter($status, $isShowPage = false)
    {
//        dd($isShowPage);
        if ($isShowPage) {
//            dd(123);
            return $this->redirectRoute('ideas.index', compact('status'));
        }
        $this->emit('updateStatusFilter', $status);
        $this->status = $status;
    }
}
