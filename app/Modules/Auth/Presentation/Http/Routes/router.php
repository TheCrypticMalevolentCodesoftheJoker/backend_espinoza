<?php

use App\Modules\Auth\Presentation\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth')->post('logout', [AuthController::class, 'destroy'])->name('logout');
});
