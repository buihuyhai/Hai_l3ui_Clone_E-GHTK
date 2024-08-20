<?php
use Modules\Product\Api\ProductController;
use Illuminate\Support\Facades\Route;
use Modules\Product\Controllers\ReviewController;
use Modules\Product\Controllers\UserOrderController;
use Modules\Product\Services\UserCreateOrderService;


Route::get('/product/list', [ProductController::class, 'index'])->name('');
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('');
Route::post("/product/add", [ProductController::class,"store"])->name("");
Route::put("/product/update", [ProductController::class,"update"])->name("");
Route::post('/product/delete', [ProductController::class, 'destroy'])->name('');
Route::get("/products/{keyword}", [ProductController::class, 'search']);


Route::post('/order/create', [UserOrderController::class,'create'])->name('user.order.create');
