<?php

namespace Modules\Cart;

use Illuminate\Support\ServiceProvider;
use Modules\Cart\Repositories\Contracts\CartRepositoryInterface;
use Modules\Cart\Repositories\Eloquent\CartRepository;
use Modules\Cart\RouteServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        // $this->app->singleton(
        //     CartRepositoryInterface::class,
        //     CartRepository::class,

        // );
        $this->app->singleton(CartService::class, function ($app) {
            return new CartService();
        });

    }





}
