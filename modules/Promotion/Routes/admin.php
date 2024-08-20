<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Hooks\RoleHook;

// Route::middleware(["auth", "role:" . RoleHook::ADMIN . '|' . RoleHook::SUPER_ADMIN,])->prefix("/")->group(function () {
//     Route::get("/", "CouponController@index")->name("index");
//     Route::get("/create", "CouponController@create")->name("create");
//     Route::get("/update/{id}", "CouponController@update")->name("update");
//     Route::post("/create", "CouponController@handleCreate");
//     Route::post("/update/{id}", "CouponController@handleUpdate");
//     Route::post("/delete/{id}", "CouponController@delete")->name("delete");
//     Route::post("/bulk-action", "CouponController@handleBulkAction")->name("bulk-action");
//     Route::post("/change-lock/{id}", "CouponController@handleChangeLockAccount")->name("change-lock");
// });
