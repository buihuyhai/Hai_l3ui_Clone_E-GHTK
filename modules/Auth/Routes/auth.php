<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\Auth\LoginController;
use Modules\Auth\Controllers\Auth\ConfirmablePasswordController;
use Modules\Auth\Controllers\Auth\EmailVerificationNotificationController;
use Modules\Auth\Controllers\Auth\EmailVerificationPromptController;
use Modules\Auth\Controllers\Auth\NewPasswordController;
use Modules\Auth\Controllers\Auth\SettingController;
use Modules\Auth\Controllers\Auth\PasswordResetLinkController;
use Modules\Auth\Controllers\Auth\RegisteredUserController;
use Modules\Auth\Controllers\Auth\VerifyEmailController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'index'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'handleRegister']);

    Route::get('login', [LoginController::class, 'index'])
        ->name('login');

    Route::post('login', [LoginController::class, 'handleLogin']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'index'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'handlePasswordResetLink'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'index'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'handleNewPassword'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::name('setting.')->group(function () {
        Route::get('setting', [SettingController::class, 'index'])->name("index");
        Route::put('setting', [SettingController::class, 'handleChangePassword'])->name('store');
    });


    Route::post('logout', [LoginController::class, 'handleLogout'])
        ->name('logout');
});
