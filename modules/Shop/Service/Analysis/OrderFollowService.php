<?php

namespace Modules\Shop\Service\Analysis;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\Models\Order;

class OrderFollowService
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

        $year = $yearRequest !== null ? $yearRequest : today()->year;

        return Order::beLongsToShop($shop->id)
            ->whereYear('created_at', $year)
            ->select('status', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('status')
            ->get()
            ->map(function ($item){
                return [
                    'status' => $item->status_name,
                    'total_orders' => $item->total_orders,
                ];
            })
            ->toArray()
        ;

    }
}
