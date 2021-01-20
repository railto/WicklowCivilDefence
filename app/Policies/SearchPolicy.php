<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Search;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SearchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Search  $search
     * @return bool
     */
    public function view(User $user, Search $search): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Search  $search
     * @return bool
     */
    public function update(User $user, Search $search): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Search  $search
     * @return bool
     */
    public function delete(User $user, Search $search): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Search  $search
     * @return bool
     */
    public function restore(User $user, Search $search): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Search  $search
     * @return bool
     */
    public function forceDelete(User $user, Search $search): bool
    {
        return false;
    }
}
