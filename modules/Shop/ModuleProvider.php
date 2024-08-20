<?php

namespace Modules\Shop;

use Illuminate\Support\ServiceProvider;
use Modules\Shop\Repositories\Contracts\ShopRepositoryInterface;
use Modules\Shop\Repositories\Eloquent\ShopRepository;
use Modules\Shop\RouteServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->singleton(
            ShopRepositoryInterface::class,
            ShopRepository::class
        );

    }





}
