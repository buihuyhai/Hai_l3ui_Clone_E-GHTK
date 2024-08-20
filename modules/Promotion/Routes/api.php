<?php

use Illuminate\Support\Facades\Route;
use Modules\Promotion\Controllers\CouponController;

// Route::prefix("v1/coupon")->group(function () {
//     Route::get("/", "V1\CouponController@index")->name("index");

//     Route::get("/all", "V1\CouponController@getAll")->name("all");

//     Route::get("/limit", "V1\CouponController@getLimit")->name("limit");

//     Route::get("/{id}", "V1\CouponController@detail")->name("detail");

//     Route::post("/create", "V1\CouponController@create")->name("create");

//     Route::post("/update/{id}", "V1\CouponController@update")->name("update");


// });
Route::post('api/coupons/apply', [CouponController::class, 'apply'])->name('api.coupons.apply');
