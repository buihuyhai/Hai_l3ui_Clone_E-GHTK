<?php
namespace Modules\Product\Services;

use Modules\Product\Models\Order;
use Modules\Product\Services\Contracts\UserOrderInterface;

class UserOrderService implements UserOrderInterface
{
    public function getUserOrder(int $userId, ?string $type = 'all')
    {
        $status = [
            'pending' => 1,
            'success' => 2,
            'cancel' => 0,
        ];
    
        $query = Order::with(['orderDetails.variant.product.shop'])
            ->where('customer_id', $userId)
            ->orderBy('created_at', 'desc');
    
        if ($type !== 'all' && array_key_exists($type, $status)) {
            $query->where('status', $status[$type]);
        }
    
        return $query->paginate(5);
    }
    
}