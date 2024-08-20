<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Controllers\CheckoutController;


Route::post('/checkout',[CheckoutController::class,"checkout"])->name('checkout');
