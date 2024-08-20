<?php

namespace Modules\Shop\Service\Analysis;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Order\Models\Order;
use Modules\Product\Models\ProductVariant;
use Modules\Shop\Models\HistoryImportProduct;

class SaleAndInventoryLatestSevenDateService
{
    public function __construct()
    {

    }

    public function handle() : array
    {
        $shop = Session::get('shop');

        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }

        $current = Carbon::now();
        $sevenDaysAgo = $current->copy()->subDays(6);

        $countOrder = [];
        $saleNumber = [];
        $inventoryNumber = [];
        for($i = 6; $i >= 0; $i--){
            $tmp = $current->copy()->subDays($i)->format('d-m-Y');
            $countOrder[$tmp] = 0;
            $saleNumber[$tmp] = 0;
            $inventoryNumber[$tmp] = 0;
        }

        $countInventoryCurrent = ProductVariant::query()
            ->whereHas('product', fn ($query) => $query->where('shop_id', $shop->id))
            ->sum('stock');


        $orders = Order::beLongsToShop($shop->id)
            ->where('created_at', '>=',$sevenDaysAgo->format('Y-m-d'))
            ->where('created_at', '<=',$current->format('Y-m-d'))
            ->whereIn('status', [StatusOrderEnum::STATUS_PENDING, StatusOrderEnum::STATUS_CONFIRMED])
            ->with('detail')
            ->get()
            ->groupBy(function ($order) {
                return $order->created_at->format('d-m-Y');
            })
        ;

        foreach ($orders as $key => $value) {
            $countOrder[$key] = $value->count();
            $saleNumber[$key] = $value->sum(function ($order){
                return $order->detail->sum(function ($detail) {
                    return $detail->quantity;
                });
            });
        }

        $inventoryAnalysis = $countInventoryCurrent;
        for($i = 0; $i <= 6; $i++){
            $tmp = $current->copy()->subDays($i)->format('d-m-Y');
            if ($i == 0){
                $inventoryNumber[$tmp] = $inventoryAnalysis;
                continue;
            }
            $infoImport = ProductVariant::query()
                ->whereHas('product', fn ($query) => $query->where('shop_id', $shop->id))
                ->with(['historyImport', fn ($query) => $query->whereDate('created_at',$tmp )])
                ->whereHas('historyImport', fn ($query) => $query->whereDate('created_at',$tmp))
                ->get()
                ->sum(function($each){
                    return $each->historyImport->sum('number');
                } );
            $change = $infoImport;
            if (array_key_exists( $tmp,$saleNumber)){
                $change -= $saleNumber[$tmp];
            }
            $inventoryAnalysis = $inventoryAnalysis + $change;
            $inventoryNumber[$tmp] = $inventoryAnalysis;
        }

        return [
            'inventory' => $inventoryNumber,
            'sale' => $saleNumber,
            'order' => $countOrder
        ];
    }
}
