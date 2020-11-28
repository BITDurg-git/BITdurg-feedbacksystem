<?php

namespace App\Policies;

use App\User;
use App\FeedbackSession;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackSessionPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any feedback sessions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        
    }

    /**
     * Determine whether the user can view the feedback session.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSession  $feedbackSession
     * @return mixed
     */
    public function view(User $user, FeedbackSession $feedbackSession)
    {
        //
    }

    /**
     * Determine whether the user can create feedback sessions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the feedback session.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSession  $feedbackSession
     * @return mixed
     */
    public function update(User $user, FeedbackSession $feedbackSession)
    {
        //
    }

    /**
     * Determine whether the user can delete the feedback session.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSession  $feedbackSession
     * @return mixed
     */
    public function delete(User $user, FeedbackSession $feedbackSession)
    {
        //
    }

    /**
     * Determine whether the user can restore the feedback session.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSession  $feedbackSession
     * @return mixed
     */
    public function restore(User $user, FeedbackSession $feedbackSession)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the feedback session.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSession  $feedbackSession
     * @return mixed
     */
    public function forceDelete(User $user, FeedbackSession $feedbackSession)
    {
        //
    }
}
