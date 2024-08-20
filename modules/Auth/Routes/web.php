<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\ProfileController;
use Modules\Auth\Controllers\Auth\SettingController;

Route::middleware('auth')->name("profile.")->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('index');
    Route::patch('/profile', [ProfileController::class, 'handleUpdateProfile'])->name('store');
    Route::delete('/profile', [SettingController::class, 'handleDeleteAccount'])->name('delete');
});

require __DIR__ . '/auth.php';
