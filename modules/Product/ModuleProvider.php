<?php

namespace Modules\Product;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Modules\Product\RouteServiceProvider;
use Modules\Product\AuthServiceProvider;
use Modules\Product\Services\CategoryService;
use Modules\Product\Services\Contracts\CategoryServiceInterface;
use Modules\Product\Services\Contracts\CreateReviewServiceInterface;
use Modules\Product\Services\Contracts\GetProductReviewServiceInterface;
use Modules\Product\Services\Contracts\ProductServiceInterface;
use Modules\Product\Services\Contracts\SearchServiceInterface;
use Modules\Product\Services\Contracts\ShopServiceInterface;
use Modules\Product\Services\Contracts\SlugServiceInterface;
use Modules\Product\Services\Contracts\UserOrderInterface;
use Modules\Product\Services\CreateReviewService;
use Modules\Product\Services\GetProductReviewService;
use Modules\Product\Services\ProductService;
use Modules\Product\Services\SearchService;
use Modules\Product\Services\ShopService;
use Modules\Product\Services\SlugService;
use Modules\Product\Services\UserOrderService;


class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(SearchServiceInterface::class, SearchService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(SlugServiceInterface::class, SlugService::class);
        $this->app->bind(ShopServiceInterface::class, ShopService::class);
        $this->app->bind(CreateReviewServiceInterface::class, CreateReviewService::class);
        $this->app->bind(UserOrderInterface::class, UserOrderService::class);
        $this->app->bind(GetProductReviewServiceInterface::class, GetProductReviewService::class);
    }
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        Paginator::useBootstrap();
    }
}
