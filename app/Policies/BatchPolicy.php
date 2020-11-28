<?php

namespace App\Policies;

use App\User;
use App\Batch;
use Illuminate\Auth\Access\HandlesAuthorization;

class BatchPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any batches.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the batch.
     *
     * @param  \App\User  $user
     * @param  \App\Batch  $batch
     * @return mixed
     */
    public function view(User $user, Batch $batch)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $batch->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can create batches.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7)
            return true;
        return false;
    }

    /**
     * Determine whether the user can update the batch.
     *
     * @param  \App\User  $user
     * @param  \App\Batch  $batch
     * @return mixed
     */
    public function update(User $user, Batch $batch)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $batch->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the batch.
     *
     * @param  \App\User  $user
     * @param  \App\Batch  $batch
     * @return mixed
     */
    public function delete(User $user, Batch $batch)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $batch->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the batch.
     *
     * @param  \App\User  $user
     * @param  \App\Batch  $batch
     * @return mixed
     */
    public function restore(User $user, Batch $batch)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $batch->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the batch.
     *
     * @param  \App\User  $user
     * @param  \App\Batch  $batch
     * @return mixed
     */
    public function forceDelete(User $user, Batch $batch)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $batch->department_name)
                return true;
            return false;
        }
        return false;
    }
}
