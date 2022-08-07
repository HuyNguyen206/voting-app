<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

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
        $this->refreshUnreadNotificationsCount($user);
    }

    public function render()
    {
        return view('livewire.comment-notification');
    }

    public function getNotification()
    {
        $this->notifications = $this->user->unreadNotifications()->latest()->take(self::MAX_NOTIFICATION_DISPLAY)->get();
        $this->isLoading = false;
    }

    public function markAllAsRead()
    {
        abort_if(!$this->user, Response::HTTP_FORBIDDEN);
        $this->user->unreadNotifications->markAsRead();
        $this->refreshUnreadNotificationsCount($this->user);
    }

    /**
     * @param User $user
     * @return void
     */
    private function refreshUnreadNotificationsCount(User $user): void
    {
        $count = $user->unreadNotifications()->count();
        $this->notificationCount = $count > self::MAX_NOTIFICATION_DISPLAY ? self::MAX_NOTIFICATION_DISPLAY . "+" : $count;
    }

    public function markAsRead($notificationId)
    {
        abort_if(!$this->user, Response::HTTP_FORBIDDEN);
        $notification = DatabaseNotification::findOrFail($notificationId);
//        $this->user->unreadNotifications()->where('id', $notificationId)->first();
        $notification->markAsRead();

        $this->scrollToComment($notification);
    }

    /**
     * @param $notification
     * @return void
     */
    private function scrollToComment($notification): void
    {
        $commentId = $notification->data['commentId'];
        session()->flash('scroll_to_comment', $commentId);
        $comment = Comment::find($commentId);
        if (!$comment) {
            session()->flash('error_message', 'Your comment was removed already!');
            $this->redirect(route('ideas.index'));
            return;
        }

        $commentIds =$comment->idea->comments()->pluck('id');
        $currentCommentIndex = $commentIds->search($commentId);
        $page = (int) ($currentCommentIndex / $comment->getPerPage()) + 1;
        $this->redirect($notification->data['linkToIdea'] . "?page=$page");
    }
}
