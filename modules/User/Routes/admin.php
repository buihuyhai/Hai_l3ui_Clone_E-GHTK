<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Hooks\RoleHook;

Route::middleware(["auth", "role:" . RoleHook::ADMIN . '|' . RoleHook::SUPER_ADMIN,])->prefix("/")->group(function () {
    Route::get("/", "UserController@index")->name("index");
    Route::get("/create", "UserController@create")->name("create");
    Route::get("/update/{id}", "UserController@update")->name("update");
    Route::post("/create", "UserController@handleCreate");
    Route::post("/update/{id}", "UserController@handleUpdate");
    Route::post("/delete/{id}", "UserController@delete")->name("delete");
    Route::post("/bulk-action", "UserController@handleBulkAction")->name("bulk-action");
    Route::post("/change-lock/{id}", "UserController@handleChangeLockAccount")->name("change-lock");


    Route::prefix('admin')->name("admin.")->group(function () {
        Route::get("/", "AdminController@index")->name("index");
        Route::get("/create", "AdminController@create")->name("create");
        Route::get("/update/{id}", "AdminController@update")->name("update");
        Route::post("/create", "AdminController@handleCreate");
        Route::post("/update/{id}", "AdminController@handleUpdate");
    });

    Route::prefix('customer')->name("customer.")->group(function () {
        Route::get("/", "CustomerController@index")->name("index");
        Route::get("/create", "CustomerController@create")->name("create");
        Route::get("/update/{id}", "CustomerController@update")->name("update");
        Route::post("/create", "CustomerController@handleCreate");
        Route::post("/update/{id}", "CustomerController@handleUpdate");
    });

    Route::prefix('vendor')->name("vendor.")->group(function () {
        Route::get("/", "VendorController@index")->name("index");
        Route::get("/create", "VendorController@create")->name("create");
        Route::get("/update/{id}", "VendorController@update")->name("update");
        Route::post("/create", "VendorController@handleCreate");
        Route::post("/update/{id}", "VendorController@handleUpdate");
    });

    Route::prefix('shop')->name("shop.")->group(function () {
        Route::get("/", "ShopController@index")->name("index");
        Route::get("/unconfirmed", "ShopController@unconfrimed")->name("unconfirmed");
        Route::post("/confirm/{id}", "ShopController@handleConfirm")->name("confirm");
        Route::get("/update/{id}", "ShopController@update")->name("update");
        Route::post("/update/{id}", "ShopController@handleUpdate");
        Route::post("/lock/{id}", "ShopController@handleLock")->name("lock");
        Route::post("/bulk-action", "ShopController@handleBulkAction")->name("bulk-action");

    });

});
