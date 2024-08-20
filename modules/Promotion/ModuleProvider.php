<?php

namespace Modules\Promotion;

use Illuminate\Support\ServiceProvider;
use Modules\Promotion\Repositories\Contracts\PromotionRepositoryInterface;
use Modules\Promotion\Repositories\Eloquent\PromotionRepository;
use Modules\Promotion\RouteServiceProvider;

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
            PromotionRepositoryInterface::class,
            PromotionRepository::class
        );

    }





}
