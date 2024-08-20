<?php

namespace Modules\Shop\Service\Analysis;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Order\Models\Order;

class AllMonthInYearService
{
    public function __construct()
    {

    }

    public function handle(?int $yearRequest) : array
    {
        $shop = Session::get('shop');

        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }
        $year = $yearRequest != null ? $yearRequest : today()->year;
        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $months[
            str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . $year
            ] = 0;
        }

        $orders = Order::beLongsToShop($shop->id)
            ->whereYear('created_at', '=',$year)
            ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            ->with('detail')
            ->get()
            ->groupBy(function ($order) {
                return $order->created_at->format('m-Y');
            });

        foreach ($months as $key => $value) {
            $revenue = 0;
            if ($orders->has($key)) {
                $revenue = $orders->get($key)->sum(function ($order){
                    return $order->detail->sum(function ($detail) {
                        return ($detail->sale_price - $detail->import_price) * $detail->quantity;
                    });
                });
            }
            $months[$key] = $revenue;
        }
        return $months;
    }
}
