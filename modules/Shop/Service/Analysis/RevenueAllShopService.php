<?php

namespace Modules\Shop\Service\Analysis;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Order\Models\Order;

class RevenueAllShopService
{
    public function __construct()
    {

    }

    public function handle() : array
    {

        // nho check them admin
//        if(!Auth::check() ){
//            throw new Exception("You must login");
//        }



        return Order::query()
            ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            ->with('detail')
            ->with('shop')
            ->get()
            ->groupBy(function ($order) {
                return $order->shop_id;
            })
            ->map(function ($byShop){
                $firstShop = $byShop->first()->shop;
                $totalRevenue = $byShop->sum(function ($eachOrder) {
                    return $eachOrder->detail->sum(function ($orderDetail) {
                        return ($orderDetail->sale_price - $orderDetail->import_price) * $orderDetail->quantity;
                    });
                });
                return [
                    'name' => $firstShop->name,
                    'totalRevenue' => $totalRevenue,
                    'logo' => $firstShop->logo_url,
                    'phone_number' => $firstShop->phone_number
                ];
            })
            ->toArray()
        ;
    }
}
