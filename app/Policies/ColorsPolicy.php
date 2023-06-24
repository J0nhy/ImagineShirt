<?php

namespace App\Policies;

use App\Models\colors;
use App\Models\User;

class ColorsPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return $user->user_type == 'A';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, colors $core): bool
    {
        return $user->user_type == 'A';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->user_type == 'A';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, colors $core): bool
    {
        return $user->user_type == 'A';
    }
}
