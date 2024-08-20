<?php

use Illuminate\Support\Facades\Route;


Route::prefix("v1/user")->group(function () {
    Route::get("/", "V1\UserController@index")->name("index");

    Route::get("/all", "V1\UserController@getAll")->name("all");

    Route::get("/limit", "V1\UserController@getLimit")->name("limit");

    Route::get("/vendor", "V1\UserController@getLimitVendor")->name("vendor");
    Route::get("/customer", "V1\UserController@getLimitCustomer")->name("customer");
    Route::get("/admin", "V1\UserController@getLimitAdmin")->name("admin");

    Route::get("/{id}", "V1\UserController@detail")->name("detail");
    // Route::delete("/delete/{id}", "V1\UserController@delete")->name("delete");
    Route::post("/create", "V1\UserController@create")->name("create");

    Route::post("/update/{id}", "V1\UserController@update")->name("update");


});

Route::prefix('v1/shop')->group(function () {
    Route::get("/", "V1\ShopController@index")->name("index");

    Route::get("/limit", "V1\ShopController@getLimit")->name("limit");



});


