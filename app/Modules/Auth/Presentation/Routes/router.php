<?php

//--------------------------------------------------------------------------
// router.php: Rutas de la API para las operaciones de autenticación de administradores
//--------------------------------------------------------------------------

use App\Modules\Auth\Presentation\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::post('login', [AuthController::class, 'store'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
    });
});
