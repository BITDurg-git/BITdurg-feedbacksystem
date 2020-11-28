<?php

namespace App\Policies;

use App\User;
use App\Relation;
use Illuminate\Auth\Access\HandlesAuthorization;

class RelationPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any relations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the relation.
     *
     * @param  \App\User  $user
     * @param  \App\Relation  $relation
     * @return mixed
     */
    public function view(User $user, Relation $relation)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $relation->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can create relations.
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
     * Determine whether the user can update the relation.
     *
     * @param  \App\User  $user
     * @param  \App\Relation  $relation
     * @return mixed
     */
    public function update(User $user, Relation $relation)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $relation->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the relation.
     *
     * @param  \App\User  $user
     * @param  \App\Relation  $relation
     * @return mixed
     */
    public function delete(User $user, Relation $relation)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $relation->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the relation.
     *
     * @param  \App\User  $user
     * @param  \App\Relation  $relation
     * @return mixed
     */
    public function restore(User $user, Relation $relation)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $relation->department_name)
                return true;
            return false;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the relation.
     *
     * @param  \App\User  $user
     * @param  \App\Relation  $relation
     * @return mixed
     */
    public function forceDelete(User $user, Relation $relation)
    {
        if($user->role == 10)
            return true;
        if($user->role == 7){
            if($user->department_name == $relation->department_name)
                return true;
            return false;
        }
        return false;
    }
}
