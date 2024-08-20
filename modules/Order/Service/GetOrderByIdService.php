<?php
namespace Modules\Order\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\DTO\Request\SearchOrderRequest;
use Modules\Order\DTO\Response\OrderDetailResponse;
use Modules\Order\DTO\Response\OrderResponse;
use Modules\Order\DTO\Response\ResponseListOrder;
use Modules\Order\Models\Order;
use Modules\Shop\DTO\Response\PaginateResponse;

/**
 *
 */
class GetOrderByIdService {
    /**
     *
     */

    public function __construct(
    ) {
    }

    /**
     * @param SearchOrderRequest $request
     * @return array
     */
    public function handle(?int $id): array
    {
        $detailList = [];

        $shop = Session::get('shop');

        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }
        if ($id === null){
            throw new Exception("You could give id");
        }

        $order = Order::beLongsToShop($shop->id)
            ->where('id',$id)
            ->with(
                'customer',
                'detail',
                'detail.variant',
                'detail.variant.product',
            )
            ->first();

        foreach ($order->detail as $detail) {
            $detailList[] = (new OrderDetailResponse(
                $detail->id,
                $detail->variant->product->name,
                $detail->quantity,
                $detail->sale_price,
                $detail->import_price,
                $detail->variant->product->thumbnail
            ))->toArray();
        }


        return (new OrderResponse(
            $order->id ?? null,
            $order->customer_name ?? null,
            $order->discount ?? null,
            $order->final_cost ?? null,
            $order->email ?? null,
            $order->address ?? null,
            $order->phone_number ?? null,
            $order->status_name ?? null,
            $order->status ?? null,
            $detailList,
        ))->toArray();


    }
}
