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
    public $isLoading = true;
    private const MAX_NOTIFICATION_DISPLAY = 5;

    public function mount(User $user)
    {
        $this->notifications = collect();
        $count = $user->unreadNotifications()->count();
        $this->notificationCount = $count > self::MAX_NOTIFICATION_DISPLAY ? self::MAX_NOTIFICATION_DISPLAY."+" : $count;
    }

    public function render()
    {
        return view('livewire.comment-notification');
    }

    public function getNotification()
    {
        sleep(10);
        $this->notifications = $this->user->unreadNotifications()->latest()->take(self::MAX_NOTIFICATION_DISPLAY)->get();
        $this->isLoading = false;
    }
}
