<?php

namespace Modules\Product\Controllers;


use Modules\Product\Services\CategoryService;
use Modules\Product\Services\GetLatestProductService;


class HomeController
{
    protected $productService;
    protected $categoryService;
    public function __construct(
        GetLatestProductService $productService,
        CategoryService $categoryService,
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $products = $this->productService->handle();
        $categories = $this->categoryService->getAll();
        return view("Product::frontend.index", compact("products", "categories"));
    }
}
