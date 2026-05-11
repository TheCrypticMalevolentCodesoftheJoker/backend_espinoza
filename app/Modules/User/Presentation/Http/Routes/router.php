<?php

use Illuminate\Support\Facades\Route;
use App\Modules\User\Presentation\Http\Controllers\UserController;

Route::prefix('user')->group(function () {

    // --------------------------------------------------
    // LECTURA
    // --------------------------------------------------
    Route::get('/', [UserController::class, 'index'])
        ->name('user.index');

    Route::get('/create', [UserController::class, 'create'])
        ->name('user.create');

    Route::get('/{id}/edit', [UserController::class, 'edit'])
        ->name('user.edit');

    Route::get('/{id}', [UserController::class, 'show'])
        ->name('user.show');

    // --------------------------------------------------
    // ESCRITURA
    // --------------------------------------------------
    Route::post('/', [UserController::class, 'store'])
        ->name('user.store');

    Route::put('/{id}', [UserController::class, 'update'])
        ->name('user.update');

    Route::patch('/{id}/activate', [UserController::class, 'activate'])
        ->name('user.activate');

    Route::patch('/{id}/deactivate', [UserController::class, 'deactivate'])
        ->name('user.deactivate');

    Route::delete('/{id}', [UserController::class, 'destroy'])
        ->name('user.destroy');
});


