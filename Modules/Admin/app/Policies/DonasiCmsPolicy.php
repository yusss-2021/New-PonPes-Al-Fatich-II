<?php

namespace Modules\Admin\Policies;

use App\Models\User;
use Modules\Admin\Models\DonasiCms;
use Illuminate\Auth\Access\HandlesAuthorization;

class DonasiCmsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_donasi::cms');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DonasiCms $donasiCms): bool
    {
        return $user->can('view_donasi::cms');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_donasi::cms');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DonasiCms $donasiCms): bool
    {
        return $user->can('update_donasi::cms');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DonasiCms $donasiCms): bool
    {
        return $user->can('delete_donasi::cms');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_donasi::cms');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, DonasiCms $donasiCms): bool
    {
        return $user->can('force_delete_donasi::cms');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_donasi::cms');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, DonasiCms $donasiCms): bool
    {
        return $user->can('restore_donasi::cms');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_donasi::cms');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, DonasiCms $donasiCms): bool
    {
        return $user->can('replicate_donasi::cms');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_donasi::cms');
    }
}
