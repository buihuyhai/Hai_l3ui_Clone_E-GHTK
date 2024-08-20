<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Hooks\RoleHook;
use Modules\User\Controllers\VendorController;


Route::middleware(["auth"])
    ->prefix("/vendor")->name("vendor.")->group(function () {
        Route::middleware(["check_vendor_registered"])->group(function () {
            Route::get("inactive-vendor", [VendorController::class, "activeNow"])->name("active-now");

            Route::post("handle-active-vendor", [VendorController::class, "handleActive"])->name("handle-active");

            Route::get('register', [VendorController::class, "register"])->name("register");
        });


    });
