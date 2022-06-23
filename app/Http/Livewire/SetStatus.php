<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use Livewire\Component;

class SetStatus extends Component
{
    public $statuses;
    public $idea;
    public $status;
    public $description;

    public function mount(Idea $idea)
    {
        $this->statuses = Status::all();
        $this->status = $idea->status_id;
        $this->idea = $idea;
    }
    public function render()
    {
        return view('livewire.set-status');
    }

    public function updateIdea()
    {
        $this->idea->update([
            'status_id' => $this->status,
        ]);
        $this->emit('updateIdea', $this->idea);
    }
}
