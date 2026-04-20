<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Category\Presentation\Http\Controllers\CategoryController;

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');

    Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show');

    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');

    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::patch('/{id}/activate', [CategoryController::class, 'activate'])->name('category.activate');

    Route::patch('/{id}/deactivate', [CategoryController::class, 'deactivate'])->name('category.deactivate');
});
