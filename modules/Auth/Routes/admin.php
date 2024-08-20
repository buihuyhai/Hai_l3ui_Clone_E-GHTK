<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Admin\RoleController;
use Modules\Auth\Admin\PermissionController;
use Modules\Auth\Controllers\Admin\LoginController;


Route::prefix('admin/')->name('auth.admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'index'])->name('login');
        Route::post('login', [LoginController::class, 'handleLogin']);
    });

    Route::middleware("auth")->group(function () {
        Route::middleware(['role:super_admin'])->prefix('/module/auth')
            ->group(function () {
                Route::prefix("role")->name("role.")->group(function () {
                    Route::get('', [RoleController::class, 'index'])->name('index');
                });

                Route::prefix('permission')->name("permission.")->group(function () {
                    Route::get('/', [PermissionController::class, 'permissionMatrix'])->name('matrix');
                    Route::post('/', [PermissionController::class, 'updatePermissionMatrix']);
                });
            });

        Route::post('logout', [LoginController::class, 'handleLogout'])
            ->name('logout');

    });


});

