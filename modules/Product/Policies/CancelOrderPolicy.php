<?php

namespace Modules\Product\Policies;


use Modules\Product\Models\Order;
use Modules\User\Models\User;

class CancelOrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function cancel(User $user, Order $order)
    {
        return $order->customer_id === $user->id;
    }
}
