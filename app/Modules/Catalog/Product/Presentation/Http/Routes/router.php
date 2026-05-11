<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Product\Presentation\Http\Controllers\ProductController;

Route::prefix('product')->group(function () {

    // --------------------------------------------------
    // LECTURA
    // --------------------------------------------------
    Route::get('/', [ProductController::class, 'index'])
        ->name('product.index');

    Route::get('/create', [ProductController::class, 'create'])
        ->name('product.create');

    Route::get('/{id}/edit', [ProductController::class, 'edit'])
        ->name('product.edit');

    Route::get('/{id}', [ProductController::class, 'show'])
        ->name('product.show');

    // --------------------------------------------------
    // ESCRITURA
    // --------------------------------------------------
    Route::post('/', [ProductController::class, 'store'])
        ->name('product.store');

    Route::patch('/{id}', [ProductController::class, 'update'])
        ->name('product.update');

    Route::patch('/{id}/activate', [ProductController::class, 'activate'])
        ->name('product.activate');

    Route::patch('/{id}/deactivate', [ProductController::class, 'deactivate'])
        ->name('product.deactivate');

    Route::delete('/{id}', [ProductController::class, 'destroy'])
        ->name('product.destroy');
});

