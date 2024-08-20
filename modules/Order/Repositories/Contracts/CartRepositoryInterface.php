<?php

namespace Modules\Order\Repositories\Contracts;

use Illuminate\Support\Collection;
use Modules\Order\Models\Cart;

interface CartRepositoryInterface
{
    /**
     * @param int $userId
     * @return Cart|null
     */
    public function getCartByUserId(int $userId) : Cart|null;

    /**
     * @param int $userId
     * @return void
     */
    public function clearCartByUserId(int $userId, array $carts) : void;
}
