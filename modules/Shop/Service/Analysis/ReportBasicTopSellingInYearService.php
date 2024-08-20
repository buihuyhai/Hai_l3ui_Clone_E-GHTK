<?php

namespace Modules\Shop\Service\Analysis;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;
use Modules\Shop\Models\Product;

class ReportBasicTopSellingInYearService
{
    public function __construct()
    {
    }

    public function handle(?int $yearRequest) : array
    {
        $shop = Session::get('shop');
        $year = $yearRequest != null ? $yearRequest : today()->year;

        $orderDetails = OrderDetail::query()
            ->with('variant')
            ->whereHas(
                'order',fn ($query) => $query
                    ->where('shop_id', $shop->id)
                    ->whereYear('created_at',$year)
                    ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            )
            ->get()
            ->groupBy(function ($query){
                return $query->variant->product_id;
            })
            ->map(function ($group) {
                return [
                    'total_quantity' => $group->sum('quantity'),
                ];
            })
            ->sortByDesc('total_quantity')
            ->take(5)
        ;

        $arrayProduct = $orderDetails->keys();

        $products = Product::query()
            ->beLongsToShop($shop->id)
            ->whereIn('id', $arrayProduct)
            ->get()
            ->map(function ($product) use ($orderDetails){
                $product->total_quantity = $orderDetails->get($product->id)['total_quantity'];
                return $product;
            })
            ->sortByDesc('total_quantity')
        ;
        return $products->toArray();
    }
}
