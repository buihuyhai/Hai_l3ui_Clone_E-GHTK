<?php

namespace Modules\Product;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Product\Models\Order;
use Modules\Product\Models\ProductVariant;
use Modules\Product\Policies\CancelOrderPolicy;
use Modules\Product\Policies\ReviewPolicy;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        ProductVariant::class => ReviewPolicy::class,
        Order::class => CancelOrderPolicy::class,
    ];
    public function boot()
    {
        $this->registerPolicies();
    }
}