<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CommentNotification extends Component
{
    public $listeners = ['getNotification'];
    public $notifications;
    public $notificationCount;
    public $user;

    public function mount(User $user)
    {
        $this->notifications = collect();
        $this->notificationCount = $user->loadCount('unreadNotifications as unreadNotificationsCount')->unreadNotificationsCount;
    }

    public function render()
    {
        return view('livewire.comment-notification');
    }

    public function getNotification()
    {
        $this->notifications = $this->user->unreadNotifications;
    }
}
