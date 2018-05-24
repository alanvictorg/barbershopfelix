<?php

namespace App\Providers;

use App\Entities\Module;
use App\Entities\Permission;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $gate->before(function (User $user) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        $permissions = Permission::with('roles')->get();
        foreach ($permissions as $permission) {

            $gate->define($permission->slug, function (User $user) use ($permission) {
                if ($user->hasPermission($permission)) {

                    return true;
                } else {
                    return false;
                }
            });

        }
    }
}
