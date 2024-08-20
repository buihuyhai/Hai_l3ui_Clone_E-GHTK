<?php

namespace Modules\Shop\Service\Analysis;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Order\Models\Order;

class RevenueInYearLyService
{
    public function __construct()
    {
    }

    public function handle(?int $yearStart, ?int $yearEnd) : array
    {
        $shop = Session::get('shop');

        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }

        if ($yearStart === null && $yearEnd === null){
            $yearEnd = today()->year;
            $yearStart = $yearEnd - 7;
        }
        elseif ($yearEnd === null || $yearStart === null || $yearEnd < $yearStart || $yearEnd - $yearStart > 7 ){
            throw new Exception('yearStart and yearEnd must be not null and yearEnd must be greater than or equal to 10');
        }

        $years = [];
        for ($year = $yearStart; $year <= $yearEnd; $year++) {
            $years[
                $year
            ] = 0;
        }

        $orders = Order::beLongsToShop($shop->id)
            ->whereYear('created_at', '>=',$yearStart)
            ->whereYear('created_at', '<=',$yearEnd)
            ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            ->with('detail')
            ->get()
            ->groupBy(function ($order) {
                return $order->created_at->format('Y');
            });

        foreach ($years as $key => $value) {
            $ans = 0;

            if ($orders->has($key)) {
                $ans = $orders->get($key)->sum(function ($order){
                    return $order->detail->sum(function ($detail) {
                        return ($detail->sale_price - $detail->import_price) * $detail->quantity;
                    });
                });
            }

            $years[$key] = $ans;

        }

        return $years;
    }
}
