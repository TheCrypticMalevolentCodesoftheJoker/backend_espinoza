<?php
//--------------------------------------------------------------------------
// router: Definición de endpoints REST del módulo User.
// Todas las rutas requieren autenticación Sanctum.
//--------------------------------------------------------------------------

use Illuminate\Support\Facades\Route;
use App\Modules\User\Presentation\Controllers\UserController;

Route::middleware('auth:sanctum')->prefix('users')->group(function () {

    //--------------------------------------------------------------------------
    // CONSULTAS -> Rutas de lectura de usuarios
    //--------------------------------------------------------------------------
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');

    //--------------------------------------------------------------------------
    // ACCIONES -> Rutas de escritura y persistencia
    //--------------------------------------------------------------------------
    Route::post('/', [UserController::class, 'store'])->name('user.store');
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
    Route::patch('/{id}/activate', [UserController::class, 'activate'])->name('user.activate');
    Route::patch('/{id}/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
