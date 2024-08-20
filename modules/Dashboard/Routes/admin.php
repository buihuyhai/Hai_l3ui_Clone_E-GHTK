<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Hooks\RoleHook;


Route::middleware(["auth", "role:" . RoleHook::ADMIN . '|' . RoleHook::SUPER_ADMIN,])
    ->prefix("/dashboard")->group(function () {
        Route::get("/", "DashboardController@index")->name("index");
    });
