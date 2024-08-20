<?php

namespace Modules\Auth;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Hooks\RoleHook;
use Modules\Auth\Repositories\Contracts\AuthRepositoryInterface;
use Modules\Auth\Repositories\Eloquent\AuthRepository;
use Modules\Auth\RouteServiceProvider;
use Modules\User\Models\User;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::before(function (User $user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }

    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('RoleHook', RoleHook::class);

        $this->app->register(RouteServiceProvider::class);


    }


}
