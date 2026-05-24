<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Role\Presentation\Controllers\RoleController;

Route::middleware('auth:sanctum')->prefix('rol')->group(function () {

    //--------------------------------------------------------------------------
    // CONSULTAS -> Rutas de lectura de roles
    //--------------------------------------------------------------------------
    Route::get('/', [RoleController::class, 'index'])->name('rol.index');
    Route::get('/active', [RoleController::class, 'active'])->name('rol.active');
    Route::get('/{id}', [RoleController::class, 'show'])->name('rol.show');

    //--------------------------------------------------------------------------
    // ACCIONES -> Rutas de escritura y persistencia
    //--------------------------------------------------------------------------
    Route::post('/', [RoleController::class, 'store'])->name('rol.store');
    Route::put('/{id}', [RoleController::class, 'update'])->name('rol.update');
    Route::patch('/{id}/activate', [RoleController::class, 'activate'])->name('rol.activate');
    Route::patch('/{id}/deactivate', [RoleController::class, 'deactivate'])->name('rol.deactivate');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('rol.destroy');
});
