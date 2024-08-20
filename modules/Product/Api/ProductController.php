<?php

namespace Modules\Product\Api;
use Illuminate\Http\Request;

use Modules\Product\Models\Product;
use Modules\Product\Requests\ProductRequest;
use Modules\Product\Services\Contracts\ProductServiceInterface;

class ProductController
{
    protected $productService;
    public function __construct(
        ProductServiceInterface $productService
    ) {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->findAll();
    }
    public function detail($id)
    {
        return $this->productService->find($id);
    }
    public function store(ProductRequest $request)
    {    
        $this->productService->create($request->validated());
        return response()->json(['message' => 'Product created successfully'], 201);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_desc' => 'required',
            'desciption' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'category_id' => 'required',
            'slug' => 'required',
            'thumbnail' => 'required',
            'shop_id' => 'required',
            'user_created'=> 'required',
            'user_updated'=> 'required',
            'variants' => 'nullable|array',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.import_price' => 'required|numeric',
            'variants.*.price' => 'required|numeric',
            'variants.*.sale_price' => 'required|numeric',
            'variants.*.stock' => 'required|numeric',
            'variants.*.media_id' => 'required',
            'variants.*.product_id' => 'required',
        ]);
        $this->productService->update($validatedData);

        return response()->json(['message' => 'Product updated successfully']);
    }

    public function destroy(Request $request)
    {
        $this->productService->delete($request->id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
    public function search($keyword)
    {
        return true;
        // return $this->productService->search($keyword);
    }
}
