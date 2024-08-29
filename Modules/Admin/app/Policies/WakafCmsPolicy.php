<?php

namespace Modules\Admin\Policies;

use App\Models\User;
use Modules\Admin\Models\WakafCms;
use Illuminate\Auth\Access\HandlesAuthorization;

class WakafCmsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_wakaf::cms');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, WakafCms $wakafCms): bool
    {
        return $user->can('view_wakaf::cms');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_wakaf::cms');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WakafCms $wakafCms): bool
    {
        return $user->can('update_wakaf::cms');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WakafCms $wakafCms): bool
    {
        return $user->can('delete_wakaf::cms');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_wakaf::cms');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, WakafCms $wakafCms): bool
    {
        return $user->can('force_delete_wakaf::cms');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_wakaf::cms');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, WakafCms $wakafCms): bool
    {
        return $user->can('restore_wakaf::cms');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_wakaf::cms');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, WakafCms $wakafCms): bool
    {
        return $user->can('replicate_wakaf::cms');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_wakaf::cms');
    }
}
