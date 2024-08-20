<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Controllers\OrderControllerApi;
use Modules\Shop\Controllers\AnalysisController;
use Modules\Shop\Controllers\AnalysisControllerApi;
use Modules\Shop\Controllers\DashboardShopController;
use Modules\Shop\Controllers\DashboardShopControllerApi;
use Modules\Shop\Controllers\ProductController;
use Modules\Shop\Controllers\ProductControllerApi;
use Modules\Shop\Controllers\ShopController;
use Modules\Shop\Controllers\ShopControllerApi;
use Modules\Shop\Middleware\ShopMiddleware;


Route::group(['prefix' => 'shops', 'as' => 'shops.'], function (){
    Route::group(['prefix' => 'api', 'as' => 'api.'], function (){
        Route::post('/register',[ShopControllerApi::class,'registerShop'])->name('register-shop');
        Route::put('/update/{id}',[ShopControllerApi::class,'update'])->name('update');
        Route::delete('/delete/{id}',[ShopControllerApi::class,'delete'])->name('delete');
        Route::post('/confirm/{id}',[ShopControllerApi::class,'confirm'])->name('confirm');
        Route::post('/changeStatus/{id}',[ShopControllerApi::class,'changeStatus'])->name('change-status');
        Route::get('/getInfoShop/{id}',[ShopControllerApi::class,'getInfoShop'])->name('get-info-shop');
        Route::group(['prefix' => 'product', 'as'=> 'product.','middleware' => [ShopMiddleware::class]], function (){
            Route::get("/",[ProductControllerApi::class,'getListProduct'])->name('get-list-product');
            Route::post("/store",[ProductControllerApi::class,'store'])->name('store');
            Route::post("/update/{id}",[ProductControllerApi::class,'update'])->name('update');
            Route::post("/delete/{id}",[ProductControllerApi::class,'delete'])->name('delete');
            Route::get("/getById/{id}",[ProductControllerApi::class,'getProductById'])->name('get-by-id');
            Route::post("/createVariant/{id}",[ProductControllerApi::class,'createVariant'])->name('create-variant');
            Route::post("/updateVariant/{id}",[ProductControllerApi::class,'updateVariant'])->name('update-variant');
            Route::post("/deleteVariant/{id}",[ProductControllerApi::class,'deleteVariant'])->name('delete-variant');
            Route::post("/importProductVariant",[ProductControllerApi::class,'importProductVariant'])->name('import-product-variant');
        });
        Route::group(['prefix' => 'orders', 'as'=> 'orders.','middleware' => [ShopMiddleware::class]], function (){
            Route::get("/",[OrderControllerApi::class,'getListOrder'])->name('get-list');
            Route::get("/getOrderById/{id}",[OrderControllerApi::class,'getOrderById'])->name('get-by-id');
            Route::post("/changeStatus/{id}",[OrderControllerApi::class,'changeStatus'])->name('change-status');
        });
        Route::group(['prefix' => 'analysis', 'as'=> 'analysis.','middleware' => [ShopMiddleware::class]], function (){
            Route::get("/reportBasic",[DashboardShopControllerApi::class,'reportBasic'])->name('report-basic');
            Route::get("/reportBasicForMonth",[DashboardShopControllerApi::class,'reportBasicForMonth'])->name('report-basic-for-month');
            Route::get("/reportBasicTopSellingInYear",[DashboardShopControllerApi::class,'reportBasicTopSellingInYear'])->name('report-basic-top-selling-in-year');
            Route::get("/orderFollowStatus",[AnalysisControllerApi::class,'orderFollowStatus'])->name('order-follow-status');
            Route::get("/analysisProductById/{id}",[AnalysisControllerApi::class,'analysisProductById'])->name('analysis-product-by-id');
            Route::get("/revenueAllMonthInYear",[AnalysisControllerApi::class,'revenueAllMonthInYear'])->name('analysis-all-month-in-year');
            Route::get("/revenueYearLy",[AnalysisControllerApi::class,'revenueYearLy'])->name('revenue-year-ly');
            Route::get("/saleAndInventoryInSevenDate",[AnalysisControllerApi::class,'saleAndInventoryInSevenDate'])->name('sale-and-inventory-in-seven-date');
        });
    });
    Route::group(['middleware' => [ShopMiddleware::class]], function () {
        Route::group(['prefix' => 'product', 'as'=> 'product.'],function (){
            Route::get("/create",[ProductController::class,'create'])->name('create');
            Route::get("/update/{id}",[ProductController::class,'update'])->name('update');
        });
        Route::get('/dashboard',[DashboardShopController::class,'dashboard'])->name('dashboard');
        Route::get('/analysis',[AnalysisController::class,'analysis'])->name('analysis');
        Route::get('/orders',[ShopController::class,'orders'])->name('orders');
        Route::get('/products',[ShopController::class,'adminProduct'])->name('products');
        Route::get('/updateShop',[ShopController::class,'updateShop'])->name('updateShop');
    });

});

Route::get('/revenueAllShop',[AnalysisControllerApi::class,'revenueAllShop']);
