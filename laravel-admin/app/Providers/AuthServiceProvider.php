<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        //
        Gate::define('view', function(User $user, $model){
            return $user->hasAccess('view_'.$model) || $user->hasAccess('edit_'.$model) ;
        });

        Gate::define('edit', function(User $user, $model){
            return $user->hasAccess('edit_'.$model) ;
        });
    }
}
