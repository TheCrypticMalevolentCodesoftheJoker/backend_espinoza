<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Brand\Presentation\Http\Controllers\BrandController;

Route::prefix('brand')->group(function () {

    // --------------------------------------------------
    // LECTURA
    // --------------------------------------------------
    Route::get('/', [BrandController::class, 'index'])
        ->name('brand.index');

    Route::get('/create', [BrandController::class, 'create'])
        ->name('brand.create');

    Route::get('/{id}/edit', [BrandController::class, 'edit'])
        ->name('brand.edit');

    Route::get('/{id}', [BrandController::class, 'show'])
        ->name('brand.show');

    // --------------------------------------------------
    // ESCRITURA
    // --------------------------------------------------
    Route::post('/', [BrandController::class, 'store'])
        ->name('brand.store');

    Route::put('/{id}', [BrandController::class, 'update'])
        ->name('brand.update');

    Route::patch('/{id}/activate', [BrandController::class, 'activate'])
        ->name('brand.activate');

    Route::patch('/{id}/deactivate', [BrandController::class, 'deactivate'])
        ->name('brand.deactivate');

    Route::delete('/{id}', [BrandController::class, 'destroy'])
        ->name('brand.destroy');
});

