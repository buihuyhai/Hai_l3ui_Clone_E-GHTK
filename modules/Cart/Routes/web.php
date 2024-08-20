<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\Controllers\CartController;
use Modules\Cart\Controllers\CheckoutController;
use Modules\Cart\Models\Cart;


Route::middleware(['auth'])->group(function () {
    Route::get('cart', [CartController::class, 'getCart'])->name('cart');
    Route::post('delete', [CartController::class, 'removeFromCart'])->name('delete');
    Route::post('add', [CartController::class, 'addToCart'])->name('add');

    Route::get('/checkout', [CheckoutController::class, 'Index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});
Route::post('/get-coupon-id', [CheckoutController::class, 'getCouponIdByCode'])->name('checkout.order');
Route::get('/cart/quantity', function() {
    $qty = 0;
    if (Auth::check()) {
        $user_id = Auth::id();
        $cart =Cart::with(['products'])->where('user_id', $user_id)->first();
        $qty = $cart ? $cart->products->sum('pivot.quantity') : 0;
    }
    return response()->json(['qty' => $qty]);
})->name('cart.quantity');
