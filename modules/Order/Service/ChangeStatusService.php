<?php
namespace Modules\Order\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\DTO\Request\SearchOrderRequest;
use Modules\Order\DTO\Response\OrderDetailResponse;
use Modules\Order\DTO\Response\OrderResponse;
use Modules\Order\DTO\Response\ResponseListOrder;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Order\Models\Order;
use Modules\Shop\DTO\Response\PaginateResponse;

/**
 *
 */
class ChangeStatusService {
    /**
     *
     */

    public function __construct(
    ) {
    }

    /**
     * @param int|null $status
     * @param int|null $id
     * @return bool
     */
    public function handle(?int $status, ?int $id): void
    {

        $shop = Session::get('shop');

        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }
        if ($id === null){
            throw new Exception("You could give id");
        }

        $order = Order::beLongsToShop($shop->id)
            ->with('detail')
            ->with('detail.variant')
            ->where('id', $id)
            ->first();

        if(is_null($order)){
            throw new Exception("Order not found");
        }

        if($order->status == StatusOrderEnum::STATUS_REJECT){
            throw new Exception("Order has been rejected");
        }

        if($status !== StatusOrderEnum::STATUS_REJECT && $status - $order->status !== 1){
            throw new Exception("Invalid status");
        }

        $order->status = $status;
        $order->save();

        if($order->status === StatusOrderEnum::STATUS_REJECT){
            foreach ($order->detail as $detail){
                $detail->variant->stock += $detail->quantity;
                $detail->variant->save();
            }
        }

    }
}
