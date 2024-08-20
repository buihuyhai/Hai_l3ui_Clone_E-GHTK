<?php

namespace Modules\Order\Repositories\Contracts;

use Modules\Order\Domain\Order;

interface OrderRepositoryInterface
{
    /**
     * @param Order $order
     * @return void
     */
    public function checkout(Order $order) : void;
}
