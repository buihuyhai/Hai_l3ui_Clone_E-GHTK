<?php

namespace Modules\Product\Services;

use Modules\Product\Models\Product;

class GetLatestProductService
{
    public function handle()
    {
        return Product::with('variants')
            ->orderBy('id', 'desc')
            ->paginate(25);
    }
}