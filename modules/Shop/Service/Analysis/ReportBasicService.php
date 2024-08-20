<?php

namespace Modules\Shop\Service\Analysis;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Order\Models\Order;

class ReportBasicService
{
    private const  TYPE_NO_CHANGE = 'no-change';
    private const  TYPE_INCREMENT = 'increment';
    private const  TYPE_DECREMENT = 'decrement';
    public function __construct()
    {

    }

    private function compareValue($thisValue, $lastValue) : array
    {
        if($lastValue != 0){
            $change = $thisValue - $lastValue;
            $percentageChange = ($change / $lastValue) * 100;
            $type = self::TYPE_NO_CHANGE;

            if ($change > 0) {
                $type = self::TYPE_INCREMENT;
            } elseif ($change < 0) {
                $type = self::TYPE_DECREMENT;
            }

            return [
                'change' => abs($percentageChange),
                'type' => $type,
                'current' => $thisValue
            ];
        }

        if( $thisValue == 0){
            return [
                'change' => 0,
                'type' => self::TYPE_NO_CHANGE,
                'current' => $thisValue
            ];
        }

        if ($thisValue != 0){
            return [
                'change' => 100,
                'type' => self::TYPE_INCREMENT,
                'current' => $thisValue
            ];
        }
        return  [];
    }

    public function handle() : array
    {
        $order = null;
        $revenue = null;
        $item = null;
        $shop = Session::get('shop');
        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }
        $orderToday = Order::beLongsToShop($shop->id)
            ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            ->whereDate('created_at', today())
            ->count();
        $orderYesterday = Order::beLongsToShop($shop->id)
            ->whereDate('created_at', today()->subDays(1))
            ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            ->count();

        $order = $this->compareValue($orderToday, $orderYesterday);

        $orderThisMonth = Order::beLongsToShop($shop->id)
            ->whereMonth('created_at', today()->month)
            ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            ->with('detail')
            ->get();


        $orderLastMonth = Order::beLongsToShop($shop->id)
            ->whereMonth('created_at', today()->subMonths(1)->month)
            ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            ->with('detail')
            ->get();


        $revenueThisMonth = $orderThisMonth
                    ->sum(function ($item){
                        return $item->detail->sum(function ($detail){
                            return ($detail->sale_price - $detail->import_price)*$detail->quantity;
                        });
                    });

        $revenueLastMonth = $orderLastMonth
                    ->sum(function ($item){
                        return $item->detail->sum(function ($detail){
                            return ($detail->sale_price - $detail->import_price)*$detail->quantity;
                        });
                    });

        $revenue = $this->compareValue($revenueThisMonth, $revenueLastMonth);

        $totalItemOrderThisMonth = $orderThisMonth
            ->sum(function ($item) {
                return $item->detail->sum('quantity');
            });

        $totalItemOrderLastMonth = $orderLastMonth
            ->sum(function ($item) {
                return $item->detail->sum('quantity');
            });

        $item = $this->compareValue($totalItemOrderThisMonth, $totalItemOrderLastMonth);

        return [
            'order' => $order,
            'revenue' => $revenue,
            'item' => $item
        ];

    }
}
