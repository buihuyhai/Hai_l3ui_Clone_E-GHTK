<?php

namespace Modules\Product\Services;
use Modules\Product\Models\Order;

class UserCancelOrderService
{
    public function handle(?int $id)
    {
        $order = Order::find($id);
        return $order->update(['status'=> 0]);
    }
}
