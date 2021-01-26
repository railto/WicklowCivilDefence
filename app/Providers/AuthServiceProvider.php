<?php

namespace App\Providers;

use App\Models\Search;
use App\Models\SearchCommsLog;
use App\Models\SearchRadioAssignment;
use App\Models\SearchTeam;
use App\Policies\SearchCommsLogPolicy;
use App\Policies\SearchPolicy;
use App\Policies\SearchRadioAssignmentPolicy;
use App\Policies\SearchTeamPolicy;
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
