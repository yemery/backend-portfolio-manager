<?php

namespace App\Policies;

use App\Models\Tool;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ToolPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tool $tool): Response
    {
        return $user->id == $tool->user_id
        ? Response::allow()
        : Response::denyWithStatus(401);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user == auth()->user()? Response::allow()
        : Response::denyWithStatus(401);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tool $tool): Response
    {
        return $user->id == $tool->user_id
        ? Response::allow()
        : Response::denyWithStatus(401);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tool $tool): Response
    {
        return $user->id == $tool->user_id
        ? Response::allow()
        : Response::denyWithStatus(401);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tool $tool): Response
    {
        return $user->id == $tool->user_id
        ? Response::allow()
        : Response::denyWithStatus(401);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tool $tool): Response
    {
        return $user->id == $tool->user_id
        ? Response::allow()
        : Response::denyWithStatus(401);
    }
}
