<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Builder;

class IdeaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Idea $idea)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Idea $idea)
    {
        return $this->authorizeUser($user, $idea);
    }

    /**
     * Determine whether the user can mark the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function markAsSpam(?User $user, Idea $idea)
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can mark the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function markAsNotSpam(?User $user, Idea $idea)
    {
        return auth()->check() && $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Idea $idea)
    {
        return $this->authorizeUser($user, $idea) || $user->isAdmin();
    }

    private function authorizeUser(?User $user, Idea $idea)
    {
        if (!$user) {
            return false;
        }
        if (now()->diffInHours($idea->created_at) > 1) {
            return false;
        }
        return (int) $idea->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Idea $idea)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Idea  $idea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Idea $idea)
    {
        //
    }

    public function editCommentOfIdea(User $user, Idea $idea)
    {
        return $idea->comments()->where(function (Builder $builder) use ($user){
            $builder->where('user_id', $user->id);
        })->exists();
    }
}
