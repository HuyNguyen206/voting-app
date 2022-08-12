<?php
namespace App\Http\Livewire\Traits;


trait Vote {

    public function vote()
    {
        if (!$userId = auth()->id()) {
            redirect()->setIntendedUrl(url()->previous());
            return $this->redirect(route('login'));
        }
        $this->idea->votedUsers()->toggle($userId);
        $this->idea->loadCount(['votedUsers as votedUsersCount']);
//        $this->idea->loadCount('comments as commentsCount');
        $this->isVoted = $this->idea->isVotedByUser($userId);
    }
}
