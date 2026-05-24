<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Category\Presentation\Controllers\CategoryController;

Route::prefix('category')->group(function () {

    //--------------------------------------------------------------------------
    // CONSULTAS -> Rutas de lectura de categorías
    //--------------------------------------------------------------------------
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/active', [CategoryController::class, 'active'])->name('category.active');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show');

    //--------------------------------------------------------------------------
    // ACCIONES -> Rutas de escritura y persistencia
    //--------------------------------------------------------------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::patch('/{id}/activate', [CategoryController::class, 'activate'])->name('category.activate');
        Route::patch('/{id}/deactivate', [CategoryController::class, 'deactivate'])->name('category.deactivate');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});
