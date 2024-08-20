<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\Controllers\CartController;
use Modules\Cart\Controllers\CheckoutController;
use Modules\Cart\CheckoutService;

// Route::prefix('cart')->group(function () {
//     Route::get('{user_id}', [CartController::class, 'getCart']);
//     Route::post('deletecart', [CartController::class, 'removeFromCart']);
//     Route::post('add', [CartController::class, 'addToCart']);
// });
Route::get('/api/provinces', [CheckoutController::class, 'getProvinces'])->name('api.provinces');
Route::post('/api/districts', [CheckoutController::class, 'getDistricts'])->name('api.districts');
Route::post('/api/wards', [CheckoutController::class, 'getWards'])->name('api.wards');



// Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
// Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
// Route::post('/order/place', [CheckoutService::class, 'storeOrders'])->name('order.place');
