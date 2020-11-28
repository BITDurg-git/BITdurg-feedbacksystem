<?php

namespace App\Policies;

use App\User;
use App\FeedbackSubmission;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackSubmissionPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any feedback submissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the feedback submission.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSubmission  $feedbackSubmission
     * @return mixed
     */
    public function view(User $user, FeedbackSubmission $feedbackSubmission)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackSubmission->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can create feedback submissions.
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
     * Determine whether the user can update the feedback submission.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSubmission  $feedbackSubmission
     * @return mixed
     */
    public function update(User $user, FeedbackSubmission $feedbackSubmission)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackSubmission->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the feedback submission.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSubmission  $feedbackSubmission
     * @return mixed
     */
    public function delete(User $user, FeedbackSubmission $feedbackSubmission)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackSubmission->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the feedback submission.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSubmission  $feedbackSubmission
     * @return mixed
     */
    public function restore(User $user, FeedbackSubmission $feedbackSubmission)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackSubmission->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the feedback submission.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackSubmission  $feedbackSubmission
     * @return mixed
     */
    public function forceDelete(User $user, FeedbackSubmission $feedbackSubmission)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackSubmission->department_name)
                return true;
            return false;
        }
        return false;
    }
}
