<?php
namespace Modules\Product\Services;

use Modules\Product\Models\Product;
use Modules\Product\Services\Contracts\ShopServiceInterface;
use Modules\Shop\Models\Shop;

class ShopService implements ShopServiceInterface
{
    private ApplyOrderByService $applyOrderByService;
    private ApplyPriceRangeService $applyPriceRangeService;
    public function __construct(
        ApplyOrderByService $applyOrderByService,
        ApplyPriceRangeService $applyPriceRangeService
    ) {

        $this->applyOrderByService = $applyOrderByService;
        $this->applyPriceRangeService = $applyPriceRangeService;
    }
    public function getShopById(int $id, ?string $categoryIds, ?string $orderby, ?string $minPrice, ?string $maxPrice): array
    {
        $shop = Shop::find($id);
        if (!$shop) {
            abort(404);
        }
        $query = Product::where('shop_id', $id);
        $this->applyOrderByService->handle($query, $orderby);
        $this->applyPriceRangeService->handle($query, $minPrice, $maxPrice);
        $products = $query->paginate(20);
        return [
            "shop" => $shop,
            "products" => $products,
            "q_orderby" => $orderby,
            "q_minprice" => $minPrice,
            "q_maxprice" => $maxPrice
        ];
    }
}