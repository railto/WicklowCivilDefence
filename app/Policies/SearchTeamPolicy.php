<?php

namespace App\Policies;

use App\Models\SearchTeam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SearchTeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchTeam  $searchTeam
     * @return mixed
     */
    public function view(User $user, SearchTeam $searchTeam)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'write']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchTeam  $searchTeam
     * @return mixed
     */
    public function update(User $user, SearchTeam $searchTeam)
    {
        return in_array($user->role, ['admin', 'write']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchTeam  $searchTeam
     * @return mixed
     */
    public function delete(User $user, SearchTeam $searchTeam)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchTeam  $searchTeam
     * @return mixed
     */
    public function restore(User $user, SearchTeam $searchTeam)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchTeam  $searchTeam
     * @return mixed
     */
    public function forceDelete(User $user, SearchTeam $searchTeam)
    {
        return false;
    }
}
