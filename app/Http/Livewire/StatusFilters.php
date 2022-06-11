<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status = 'all';
    protected $queryString = ['status'];
    public function render()
    {
        $statusCount = [];
        Status::withCount('ideas as count')->get()->each(function ($status) use(&$statusCount){
            $statusCount[$status->name] = $status->count;
        });
        $statusCount['All'] = array_sum($statusCount);
        return view('livewire.status-filters', compact('statusCount'));
    }

    public function updateStatusFilter($status)
    {
        $this->emit('updateStatusFilter', $status);
        $this->status = $status;
    }
}
