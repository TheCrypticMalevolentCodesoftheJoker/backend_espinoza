<?php
//--------------------------------------------------------------------------
// router: Definición de endpoints REST del módulo Product.
// Separa rutas públicas de lectura y rutas protegidas de escritura con Sanctum.
//--------------------------------------------------------------------------

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Product\Presentation\Controllers\ProductController;

Route::prefix('product')->group(function () {

    //--------------------------------------------------------------------------
    // CONSULTAS -> Rutas de lectura de productos
    //--------------------------------------------------------------------------
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('product.show');

    //--------------------------------------------------------------------------
    // ACCIONES -> Rutas de escritura y persistencia
    //--------------------------------------------------------------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::patch('/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::patch('/{id}/activate', [ProductController::class, 'activate'])->name('product.activate');
        Route::patch('/{id}/deactivate', [ProductController::class, 'deactivate'])->name('product.deactivate');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });
});
