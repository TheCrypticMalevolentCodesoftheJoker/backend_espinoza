<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Catalog\Product\Presentation\Http\Controllers\ProductController;

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('product.show');

    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
});
