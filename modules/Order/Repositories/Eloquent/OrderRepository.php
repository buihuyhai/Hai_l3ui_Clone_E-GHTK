<?php

namespace Modules\Order\Repositories\Eloquent;

use Mockery\Exception;
use Modules\Order\Domain\Order;
use Modules\Order\Models\Order as OrderModel;
use Modules\Order\Models\OrderDetail;
use Modules\Order\Repositories\Contracts\OrderRepositoryInterface;
use Modules\Product\Models\ProductVariant;
use Modules\Shop\Models\Product;

class OrderRepository implements OrderRepositoryInterface
{

    /**
     * @param Order $order
     * @return void
     */
    public function checkout(Order $order): void
    {
        $orderDetail = [];
        $orderSave =  OrderModel::create([
            'customer_id' => $order->getCustomerId(),
            'shop_id' => $order->getShopId(),
            'discount' => $order->getDiscount(),
            'final_cost' => $order->getFinalCost(),
            'order_date' => now(),
            'email' => $order->getEmail(),
            'address' => $order->getAddress(),
            'phone_number' => $order->getPhoneNumber(),
            'description' => $order->getDescription(),
            'status' => $order->getStatus(),
        ]);
        foreach ($order->getOrderDetails() as $detail) {
            $orderDetail[] = [
                'quantity' => $detail->getQuantity(),
                'variant_id' => $detail->getVariantId(),
                'order_id' => $orderSave->id,
                'sale_price' => $detail->getSalePrice(),
                'import_price' => $detail->getImportPrice(),
            ];
            $productVariant = ProductVariant::query()
                ->where('id', $detail->getVariantId())
                ->where('stock', '>=' , $detail->getQuantity())
                ->first();
            if(is_null($productVariant)){
                throw new Exception("Product variant out of stock");
            }
            $productVariant->stock -= $detail->getQuantity();
            $productVariant->save();
        }

        OrderDetail::insert($orderDetail);
    }
}
