<?php

namespace Modules\Product\Policies;


use Modules\Product\Models\OrderDetail;
use Modules\Product\Models\ProductVariant;
use Modules\User\Models\User;

class ReviewPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function create(User $user, ProductVariant $product)
    {
        return OrderDetail::whereHas('order', function ($query) use ($user) {
            $query->where('customer_id', $user->id)
                ->where('status', 2);
        })->where('variant_id', $product->id)->exists();
    }
}
