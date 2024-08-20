<?php

use Illuminate\Support\Facades\Route;
use Modules\Promotion\Controllers\CouponController;
Route::middleware(['auth'])->group(function () {
Route::get('coupon', [CouponController::class, 'getAll'])->name('coupon.admin.index');
Route::post('deletecoupon/{id}', [CouponController::class, 'delete'])->name('coupon.admin.delete');
Route::get('coupons/edit/{id}', [CouponController::class, 'edit'])->name('coupon.admin.edit');
Route::put('coupons/update/{id}', [CouponController::class, 'update'])->name('coupon.admin.update');
Route::get('coupons/addui', [CouponController::class,'getAdd'])->name('coupon.admin.addui');
Route::post('coupons/add', [CouponController::class, 'addCoupon'])->name('coupon.admin.add');
});

Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply-coupon');
