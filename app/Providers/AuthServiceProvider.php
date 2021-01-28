<?php

namespace App\Providers;

use App\Models\Search;
use App\Models\SearchCommsLog;
use App\Models\SearchLog;
use App\Models\SearchRadioAssignment;
use App\Models\SearchTeam;
use App\Models\User;
use App\Policies\SearchCommsLogPolicy;
use App\Policies\SearchLogPolicy;
use App\Policies\SearchPolicy;
use App\Policies\SearchRadioAssignmentPolicy;
use App\Policies\SearchTeamPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Search::class => SearchPolicy::class,
        SearchTeam::class => SearchTeamPolicy::class,
        SearchRadioAssignment::class => SearchRadioAssignmentPolicy::class,
        SearchCommsLog::class => SearchCommsLogPolicy::class,
        SearchLog::class => SearchLogPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
