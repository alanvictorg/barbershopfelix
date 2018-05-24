<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ClientRepository::class, \App\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProductRepository::class, \App\Repositories\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PriceRepository::class, \App\Repositories\PriceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ServiceRepository::class, \App\Repositories\ServiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ServiceItemRepository::class, \App\Repositories\ServiceItemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CashFlowRepository::class, \App\Repositories\CashFlowRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PaymentRepository::class, \App\Repositories\PaymentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EventModelRepository::class, \App\Repositories\EventModelRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoleRepository::class, \App\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ModuleRepository::class, \App\Repositories\ModuleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ModuleRoleRepository::class, \App\Repositories\ModuleRoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PermissionRepository::class, \App\Repositories\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoleUserRepository::class, \App\Repositories\RoleUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RolePermissionRepository::class, \App\Repositories\RolePermissionRepositoryEloquent::class);
        //:end-bindings:
    }
}
