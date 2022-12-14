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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //クリエイターのみに許可
        Gate::define('creator', function (User $user) {
            return $user->role === 0;
        });

        //一般ユーザーのみに許可
        Gate::define('general', function (User $user) {
            return $user->role === 1;
        });
    }
}
