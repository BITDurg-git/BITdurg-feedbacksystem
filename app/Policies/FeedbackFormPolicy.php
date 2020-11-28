<?php

namespace App\Policies;

use App\User;
use App\FeedbackForm;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackFormPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any feedback forms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return true;
        if($user->role == 10)
            return true;
        return false;
    }

    /**
     * Determine whether the user can view the feedback form.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackForm  $feedbackForm
     * @return mixed
     */
    public function view(User $user, FeedbackForm $feedbackForm)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackForm->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can create feedback forms.
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
     * Determine whether the user can update the feedback form.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackForm  $feedbackForm
     * @return mixed
     */
    public function update(User $user, FeedbackForm $feedbackForm)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackForm->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the feedback form.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackForm  $feedbackForm
     * @return mixed
     */
    public function delete(User $user, FeedbackForm $feedbackForm)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackForm->department_name && $feedbackForm->feedback_status != 2)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the feedback form.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackForm  $feedbackForm
     * @return mixed
     */
    public function restore(User $user, FeedbackForm $feedbackForm)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackForm->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the feedback form.
     *
     * @param  \App\User  $user
     * @param  \App\FeedbackForm  $feedbackForm
     * @return mixed
     */
    public function forceDelete(User $user, FeedbackForm $feedbackForm)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $feedbackForm->department_name)
                return true;
            return false;
        }
        return false;
    }

    public function viewReport(User $user){
        if($user->role == 10)
            return true;
        return false;
    }
}
