<?php

namespace Modules\Order;

use Illuminate\Support\ServiceProvider;
use Modules\Order\Repositories\Contracts\OrderRepositoryInterface;
use Modules\Order\Repositories\Eloquent\OrderRepository;
use Modules\Order\RouteServiceProvider;

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
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

    }





}
