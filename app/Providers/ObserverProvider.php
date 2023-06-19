<?php

namespace App\Providers;

use App\Models\Oficina\{
    Resource,
    Role,
};

use App\Observers\Oficina\{
    ResourceObserver,
    RoleObserver
};

use Illuminate\Support\ServiceProvider;

class ObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //Configurações
        Role::observe(RoleObserver::class);
        Resource::observe(ResourceObserver::class);
        //Configurações
    }
}
