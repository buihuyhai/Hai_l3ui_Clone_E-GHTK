<?php

namespace Modules\Product\Services;

use Modules\Product\Models\Product;

class GetProductBySlugService
{
    private $reviewService;
    public function __construct(GetProductReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }
    public function handle(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->with('shop')
            ->first();
        $product['reviews'] = $this->reviewService->handle($product['id'], null);
        return $product;
    }
}