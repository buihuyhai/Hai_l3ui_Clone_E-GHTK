<?php

namespace Modules\Cart\Controllers;

use Modules\Cart\CartService;
use Modules\Cart\Requests\CartRequest;
use Auth;



class CartController
{
    protected $cartService;
    protected $totalquantity;
    public function __construct(
        CartService $cartService,

    ) {
        $this->cartService = $cartService;

    }

    public function getCart()
    {
        if (!Auth::check()) {
            return abort(403, 'Bạn không có quyền truy cập giỏ hàng.');
        }
        $cart = $this->cartService->getCartDetails();

        if (!$cart) {
            return abort(404, 'Không tìm thấy giỏ hàng');
        }

        $productsByShop = $this->cartService->groupProductsByShop($cart);

        return view('Cart::frontend.ViewCartUI', compact('cart', 'productsByShop'));
    }
    public function removeFromCart(CartRequest $request)
    {
        $product_variant_id = $request->input('product_variant_id');
        if (!$product_variant_id) {
            return abort(404, 'Không tìm thấy sản phẩm');
        }
        $result = $this->cartService->removeFromCart($product_variant_id);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'new_Quantity' => $result['new_Quantity']
            ]);
        }
        return response()->json([
            'success' => false
        ]);

    }
    public function addToCart(CartRequest $request)
    {
        if (!Auth::check()) {
            return abort(403, 'Bạn không có quyền thêm vào giỏ hàng.');
        }
        $product_variant_id = $request->input('product_variant_id');
        $quantity = $request->input('quantity');

        $cart = $this->cartService->addToCart($product_variant_id, $quantity);

        if (!$cart) {
            return abort(404);
        } else {
            return response()->json(['successful' => true]);
        }
    }

}
