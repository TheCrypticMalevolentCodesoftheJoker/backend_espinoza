<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Category\Presentation\Http\Controllers\CategoryController;

Route::prefix('category')->group(function () {

    // --------------------------------------------------
    // LECTURA
    // --------------------------------------------------
    Route::get('/', [CategoryController::class, 'index'])
        ->name('category.index');

    Route::get('/create', [CategoryController::class, 'create'])
        ->name('category.create');

    Route::get('/{id}/edit', [CategoryController::class, 'edit'])
        ->name('category.edit');

    Route::get('/{id}', [CategoryController::class, 'show'])
        ->name('category.show');

    // --------------------------------------------------
    // ESCRITURA
    // --------------------------------------------------
    Route::post('/', [CategoryController::class, 'store'])
        ->name('category.store');

    Route::put('/{id}', [CategoryController::class, 'update'])
        ->name('category.update');

    Route::patch('/{id}/activate', [CategoryController::class, 'activate'])
        ->name('category.activate');

    Route::patch('/{id}/deactivate', [CategoryController::class, 'deactivate'])
        ->name('category.deactivate');

    Route::delete('/{id}', [CategoryController::class, 'destroy'])
        ->name('category.destroy');
});
