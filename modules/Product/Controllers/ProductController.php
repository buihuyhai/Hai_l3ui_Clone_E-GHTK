<?php

namespace Modules\Product\Controllers;

use Modules\Product\Services\GetProductBySlugService;

class ProductController
{

    protected $productService;

    public function __construct(
        GetProductBySlugService $productService
    ) {
        $this->productService = $productService;

    }
    public function index(string $slug)
    {
        $product = $this->productService->handle($slug);
        return view("Product::frontend.product", compact('product'));
    }
}
