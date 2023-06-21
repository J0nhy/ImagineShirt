<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->user_type == 'A';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $categoria): bool
    {
        //$categoria = Category::findOrFail($category);
        return $user->user_type == 'A' ;
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
    public function update(User $user, Category $categoria): bool
    {
        return $user->user_type == 'A';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $categoria): bool
    {
        return $user->user_type == 'A';
    }

}
