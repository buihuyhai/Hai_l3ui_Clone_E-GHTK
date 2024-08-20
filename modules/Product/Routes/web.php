<?php

use Illuminate\Support\Facades\Route;

use Modules\Product\Controllers\CategoryController;
use Modules\Product\Controllers\HomeController;
use Modules\Product\Controllers\ProductController;
use Modules\Product\Controllers\ReviewController;
use Modules\Product\Controllers\SearchController;
use Modules\Product\Controllers\ShopController;
use Modules\Product\Controllers\UserOrderController;




Route::get("/home", [HomeController::class, 'index'])->name('home');
Route::get("product/{slug}", [ProductController::class, "index"])->name("product.detail");
Route::get("/search", [SearchController::class, 'search'])->name('products.search');
Route::get("category/{slug}", [CategoryController::class, "index"])->name("category.products");
Route::get("/shop/{id}", [ShopController::class, "index"])->name("shop.detail");
Route::get("/shop/filter/{slug}", [ShopController::class, "filter"])->name("shop.filter");
Route::get("/product/{slug}/review", [ReviewController::class,"filter"])->name("");

Route::middleware(['auth'])->group(function () {
    Route::get('review/test', function () {
        return view('Product::test');
    });
    Route::post('/product/{slug}/review', [ReviewController::class, 'create']);
    Route::get('/order/list', [UserOrderController::class, 'index'])->name('user.order');
    Route::post('/order/cancel/', [UserOrderController::class, 'cancel'])->name('user.order.cancel');
});
