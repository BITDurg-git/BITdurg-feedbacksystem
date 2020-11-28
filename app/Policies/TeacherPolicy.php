<?php

namespace App\Policies;

use App\User;
use App\Teacher;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any teachers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function view(User $user, Teacher $teacher)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $teacher->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can create teachers.
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
     * Determine whether the user can update the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function update(User $user, Teacher $teacher)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $teacher->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function delete(User $user, Teacher $teacher)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $teacher->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function restore(User $user, Teacher $teacher)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $teacher->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function forceDelete(User $user, Teacher $teacher)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $teacher->department_name)
                return true;
            return false;
        }
        return false;
    }
}
