<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacation;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_vacation::vacation');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vacation $vacation): bool
    {
        return $user->can('view_vacation::vacation');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_vacation::vacation');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vacation $vacation): bool
    {
        return $user->can('update_vacation::vacation');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vacation $vacation): bool
    {
        return $user->can('delete_vacation::vacation');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_vacation::vacation');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Vacation $vacation): bool
    {
        return $user->can('force_delete_vacation::vacation');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_vacation::vacation');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Vacation $vacation): bool
    {
        return $user->can('restore_vacation::vacation');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_vacation::vacation');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Vacation $vacation): bool
    {
        return $user->can('replicate_vacation::vacation');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_vacation::vacation');
    }
}
