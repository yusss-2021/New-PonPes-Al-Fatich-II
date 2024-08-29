<?php

namespace Modules\Admin\Policies;

use App\Models\User;
use Modules\Admin\Models\GalleryCms;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryCmsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_gallery::cms');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GalleryCms $galleryCms): bool
    {
        return $user->can('view_gallery::cms');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_gallery::cms');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GalleryCms $galleryCms): bool
    {
        return $user->can('update_gallery::cms');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GalleryCms $galleryCms): bool
    {
        return $user->can('delete_gallery::cms');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_gallery::cms');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, GalleryCms $galleryCms): bool
    {
        return $user->can('force_delete_gallery::cms');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_gallery::cms');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, GalleryCms $galleryCms): bool
    {
        return $user->can('restore_gallery::cms');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_gallery::cms');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, GalleryCms $galleryCms): bool
    {
        return $user->can('replicate_gallery::cms');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_gallery::cms');
    }
}
