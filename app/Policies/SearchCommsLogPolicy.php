<?php

namespace App\Policies;

use App\Models\Search;
use App\Models\SearchCommsLog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SearchCommsLogPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchCommsLog  $searchCommsLog
     * @return mixed
     */
    public function view(User $user, SearchCommsLog $searchCommsLog)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @param Search $search
     * @return mixed
     */
    public function create(User $user, Search $search)
    {
        if (!is_null($search->end)) {
            return $this->deny('You can not add a comms log entry to a search that has ended!');
        }

        return in_array($user->role, ['admin', 'write']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchCommsLog  $searchCommsLog
     * @return mixed
     */
    public function update(User $user, SearchCommsLog $searchCommsLog)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchCommsLog  $searchCommsLog
     * @return mixed
     */
    public function delete(User $user, SearchCommsLog $searchCommsLog)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchCommsLog  $searchCommsLog
     * @return mixed
     */
    public function restore(User $user, SearchCommsLog $searchCommsLog)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SearchCommsLog  $searchCommsLog
     * @return mixed
     */
    public function forceDelete(User $user, SearchCommsLog $searchCommsLog)
    {
        //
    }
}
