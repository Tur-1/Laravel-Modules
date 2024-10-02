<?php

namespace {namespace};

use Illuminate\Auth\Access\Response;
use {modulePath}\Models\{Model};
use App\Models\User;

class {class}Policy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, {Model} ${modelVariable})
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, {Model} ${modelVariable})
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, {Model} ${modelVariable})
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, {Model} ${modelVariable})
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, {Model} ${modelVariable})
    {
        //
    }
}
