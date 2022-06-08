<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class IdealIndex extends Component
{
    public $idea;
//
    public function mount($idea)
    {
        $this->idea = $idea;
    }
    public function render()
    {
        return view('livewire.ideal-index');
    }
}
