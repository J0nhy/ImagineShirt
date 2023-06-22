<?php

namespace App\Policies;

use App\Models\User;
use App\Models\users;

class UsersPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $use): bool
    {
        return $use->user_type == 'A';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $use, users $user): bool
    {
        //$categoria = Category::findOrFail($category);
        return $use->user_type == 'A' ;
        //return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->user_type == 'A';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $use, users $user): bool
    {
        return $use->user_type == 'A';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $use, users $user): bool
    {
        return $use->user_type == 'A';
    }
}
