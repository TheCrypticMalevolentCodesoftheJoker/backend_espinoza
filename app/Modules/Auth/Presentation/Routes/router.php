<?php

use App\Modules\Auth\Presentation\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    //--------------------------------------------------------------------------
    // PÚBLICO -> Autenticación
    //--------------------------------------------------------------------------
    Route::post('login', [AuthController::class, 'store'])->name('login');

    //--------------------------------------------------------------------------
    // PROTEGIDO -> Gestión de sesión
    //--------------------------------------------------------------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
    });
});
