<?php

namespace Modules\Cart;

use Modules\Cart\Models\Cart;
use Modules\Product\Models\ProductVariant;
use Modules\Product\Models\Product;
use Modules\Shop\Models\Shop;
use Modules\User\Models\User;
use DB;

class CheckoutService
{
    public function getCheckout($userId)
    {
        $checkout = User::find($userId)->cart()->first();

        if (!$checkout) {
            return abort(404, 'Lỗi: Hãy đăng nhập trước');
        }

        return $checkout;
    }

    public function processItems($items)
    {
        $groupedItems = [];
        foreach ($items as $item) {

            if (is_string($item)) {
                $itemData = json_decode($item, true);
            } elseif (is_array($item)) {
                $itemData = $item;
            } else {
                continue;
            }

            $productVariant = ProductVariant::find($itemData['product_variant_id']);
            if ($productVariant) {
                $product = Product::find($productVariant->product_id);
                if ($product) {
                    $shop = Shop::find($product->shop_id);
                    if ($shop) {
                        $shopName = $shop->name;

                        $cartProductId = DB::table('cart_products')
                            ->where('product_variant_id', $itemData['product_variant_id'])
                            ->value('id');

                        $totalItemPrice = $productVariant->sale_price * $itemData['quantity'];

                        if (!isset($groupedItems[$shopName])) {
                            $groupedItems[$shopName] = [
                                'shop_id' => $shop->id,
                                'shop_name' => $shopName,
                                'items' => [],
                                'total_price' => 0,
                            ];
                        }

                        $groupedItems[$shopName]['items'][] = [
                            'product' => $product,
                            'product_variant_id' => $productVariant->id,
                            'quantity' => $itemData['quantity'],
                            'total_price' => $totalItemPrice,
                            'cart_products_id' => $cartProductId,
                        ];

                        $groupedItems[$shopName]['total_price'] += $totalItemPrice;
                    }
                }
            }
        }
        return $groupedItems;
    }


}
