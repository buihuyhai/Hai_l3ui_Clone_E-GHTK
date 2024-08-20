<?php
namespace Modules\Product\Controllers;
use Illuminate\Http\Request;
use Modules\Product\Services\Contracts\ShopServiceInterface;

class ShopController
{
    private $shopService;
    public function __construct(ShopServiceInterface $shopService)
    {
        $this->shopService = $shopService;
    }
    public function index(Request $request)
    {
        $data = $this->shopService->getShopById($request->id, $request->categories, $request->orderby, $request->minPrice, $request->maxPrice);
        if(request()->ajax()) {
            $products = $data['products'];
            return view("Product::frontend.components.product.list", compact("products"));
        }
        return view("Product::frontend.shop", compact("data"));
    }
}