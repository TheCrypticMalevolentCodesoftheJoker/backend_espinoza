<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Brand\Presentation\Controllers\BrandController;

Route::prefix('brand')->group(function () {

    //--------------------------------------------------------------------------
    // CONSULTAS -> Rutas de lectura de marcas
    //--------------------------------------------------------------------------
    Route::get('/', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/active', [BrandController::class, 'active'])->name('brand.active');
    Route::get('/{id}', [BrandController::class, 'show'])->name('brand.show');

    //--------------------------------------------------------------------------
    // ACCIONES -> Rutas de escritura y persistencia
    //--------------------------------------------------------------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [BrandController::class, 'store'])->name('brand.store');
        Route::put('/{id}', [BrandController::class, 'update'])->name('brand.update');
        Route::patch('/{id}/activate', [BrandController::class, 'activate'])->name('brand.activate');
        Route::patch('/{id}/deactivate', [BrandController::class, 'deactivate'])->name('brand.deactivate');
        Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    });
});
