<?php

namespace Modules\User;

use Illuminate\Support\ServiceProvider;
use Modules\User\Services\GetUserService;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);



    }


}
