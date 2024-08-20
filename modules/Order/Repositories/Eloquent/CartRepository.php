<?php

namespace Modules\Order\Repositories\Eloquent;

use Illuminate\Support\Collection;
use Modules\Order\Models\Cart;
use Modules\Order\Models\CartDetail;
use Modules\Order\Repositories\Contracts\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{

    /**
     * @param int $userId
     * @return Cart|null
     */
    public function getCartByUserId(int $userId) : Cart|null
    {
        return Cart::query()
            ->where('user_id', $userId)
            ->with(['productVariant'
                => fn($query) => $query->join('products', 'product_variants.product_id', '=', 'products.id')
                    ->select('product_variants.*','products.shop_id as shop_id')
            ])
            ->first();
    }

    /**
     * @param int $userId
     * @return void
     */
    public function clearCartByUserId(int $userId, array $carts): void
    {
        CartDetail::query()
            ->whereHas('cart', fn ($query) => $query->where('user_id', $userId))
            ->whereIn('id', $carts)
            ->delete();
    }
}
