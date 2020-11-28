<?php

namespace App\Policies;

use App\User;
use App\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any subjects.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the subject.
     *
     * @param  \App\User  $user
     * @param  \App\Subject  $subject
     * @return mixed
     */
    public function view(User $user, Subject $subject)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $subject->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can create subjects.
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
     * Determine whether the user can update the subject.
     *
     * @param  \App\User  $user
     * @param  \App\Subject  $subject
     * @return mixed
     */
    public function update(User $user, Subject $subject)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $subject->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the subject.
     *
     * @param  \App\User  $user
     * @param  \App\Subject  $subject
     * @return mixed
     */
    public function delete(User $user, Subject $subject)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $subject->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the subject.
     *
     * @param  \App\User  $user
     * @param  \App\Subject  $subject
     * @return mixed
     */
    public function restore(User $user, Subject $subject)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $subject->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the subject.
     *
     * @param  \App\User  $user
     * @param  \App\Subject  $subject
     * @return mixed
     */
    public function forceDelete(User $user, Subject $subject)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $subject->department_name)
                return true;
            return false;
        }
        return false;
    }
}
