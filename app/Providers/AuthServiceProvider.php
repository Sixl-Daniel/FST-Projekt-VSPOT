<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-admin-menu', function($user){
            return $user->hasAnyRoles(['Superadmin', 'Admin']);
        });

        Gate::define('manage-vspot', function($user){
            return $user->hasAnyRoles(['Superadmin', 'Admin']);
        });

        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['Superadmin', 'Admin']);
        });

        Gate::define('manage-signage', function($user){
            return $user->hasAnyRoles(['Superadmin', 'Admin', 'User']);
        });

        Gate::define('run-tests', function($user){
            return $user->hasAnyRoles(['Superadmin', 'Admin', 'Tester']);
        });

    }
}
