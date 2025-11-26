<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
<<<<<<< HEAD
        return true;
=======

        if (auth()->user()->hasPermissionTo('view users'))
            return true;
        else
            return false;
>>>>>>> f9b6eb56666e6c1762983dd4ea39217985f1215f
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
<<<<<<< HEAD
        return true;
=======
        if (auth()->user()->hasPermissionTo('view users'))
            return true;
        else
            return false;
>>>>>>> f9b6eb56666e6c1762983dd4ea39217985f1215f
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
<<<<<<< HEAD
        return true;
=======
        if (auth()->user()->hasPermissionTo('create users'))
            return true;
        else
            return false;
>>>>>>> f9b6eb56666e6c1762983dd4ea39217985f1215f
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
<<<<<<< HEAD
        return true;
=======
        if (auth()->user()->hasPermissionTo('edit users'))
            return true;
        else
            return false;
>>>>>>> f9b6eb56666e6c1762983dd4ea39217985f1215f
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
<<<<<<< HEAD
        return true;
=======
        if (auth()->user()->hasPermissionTo('delete users'))
            return true;
        else
            return false;
>>>>>>> f9b6eb56666e6c1762983dd4ea39217985f1215f
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
<<<<<<< HEAD
        return true;
=======
        if (auth()->user()->hasRole('super admin'))
            return true;
        else
            return false;
>>>>>>> f9b6eb56666e6c1762983dd4ea39217985f1215f
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
<<<<<<< HEAD
        return true;
=======
        if (auth()->user()->hasRole('super admin'))
            return true;
        else
            return false;
>>>>>>> f9b6eb56666e6c1762983dd4ea39217985f1215f
    }
}
