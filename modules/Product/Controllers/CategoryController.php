<?php

namespace Modules\Product\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Product\Services\CategoryService;

class CategoryController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        $category = $this->categoryService->getBySlug($request);
        if (!$category) {
            return abort(404);
        }
        if ($request->ajax()) {
            $products = $category->products;
            return view("Product::frontend.components.product.list", compact("products"));
        }
        return view('Product::frontend.category', compact('category'));
    }
}
