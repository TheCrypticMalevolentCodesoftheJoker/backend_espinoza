<?php

//--------------------------------------------------------------------------
// router.php: Definición de rutas HTTP para el módulo de categorías
//--------------------------------------------------------------------------

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Category\Presentation\Controllers\CategoryController;

Route::prefix('category')->group(function () {

    //--------------------------------------------------------------------------
    // Consulta: Definición de endpoints para lecturas y búsquedas
    //--------------------------------------------------------------------------
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/active', [CategoryController::class, 'active'])->name('category.active');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show');

    //--------------------------------------------------------------------------
    // Persistencia: Endpoints protegidos para mutación y control de estado
    //--------------------------------------------------------------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::patch('/{id}/activate', [CategoryController::class, 'activate'])->name('category.activate');
        Route::patch('/{id}/deactivate', [CategoryController::class, 'deactivate'])->name('category.deactivate');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});
