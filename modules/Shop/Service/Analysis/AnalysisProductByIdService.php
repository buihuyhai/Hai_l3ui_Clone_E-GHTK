<?php

namespace Modules\Shop\Service\Analysis;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;
use Modules\Product\Models\ProductVariant;

class AnalysisProductByIdService
{
    public function __construct()
    {

    }

    public function handle(?int $productVariantId) : array
    {
        $shop = Session::get('shop');
        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }

        $productVariant = ProductVariant::query()
            ->where('id', $productVariantId)
            ->with(['product' => fn ($query) => $query->where('shop_id', $shop->id)])
            ->whereHas('product', fn ($query) => $query->where('shop_id', $shop->id))
            ->first();

        $orderDetails = OrderDetail::query()
            ->where('variant_id', $productVariantId)
            ->whereHas(
                'order',fn ($query) => $query
                ->where('shop_id', $shop->id)
                ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            )
            ->get();

        $productVariant->total_quantity = $orderDetails->sum(function ($detail){
            return $detail->quantity;
        });
        $productVariant->sales = $orderDetails->sum(function ($detail){
            return ($detail->sale_price - $detail->import_price)*$detail->quantity;
        });

        return $productVariant->toArray();

    }
}
