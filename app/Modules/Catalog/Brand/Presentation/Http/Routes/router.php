<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Brand\Presentation\Http\Controllers\BrandController;

Route::prefix('brand')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('brand.index');

    Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/', [BrandController::class, 'store'])->name('brand.store');

    Route::get('/{id}', [BrandController::class, 'show'])->name('brand.show');

    Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/{id}', [BrandController::class, 'update'])->name('brand.update');

    Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');

    Route::patch('/{id}/activate', [BrandController::class, 'activate'])->name('brand.activate');

    Route::patch('/{id}/deactivate', [BrandController::class, 'deactivate'])->name('brand.deactivate');
});
