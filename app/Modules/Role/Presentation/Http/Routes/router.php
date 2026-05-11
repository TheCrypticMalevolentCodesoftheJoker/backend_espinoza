<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Role\Presentation\Http\Controllers\RoleController;

Route::prefix('role')->group(function () {

    // --------------------------------------------------
    // LECTURA
    // --------------------------------------------------
    Route::get('/', [RoleController::class, 'index'])
        ->name('role.index');

    Route::get('/create', [RoleController::class, 'create'])
        ->name('role.create');

    Route::get('/{id}/edit', [RoleController::class, 'edit'])
        ->name('role.edit');

    Route::get('/{id}', [RoleController::class, 'show'])
        ->name('role.show');

    // --------------------------------------------------
    // ESCRITURA
    // --------------------------------------------------
    Route::post('/', [RoleController::class, 'store'])
        ->name('role.store');

    Route::put('/{id}', [RoleController::class, 'update'])
        ->name('role.update');

    Route::patch('/{id}/activate', [RoleController::class, 'activate'])
        ->name('role.activate');

    Route::patch('/{id}/deactivate', [RoleController::class, 'deactivate'])
        ->name('role.deactivate');

    Route::delete('/{id}', [RoleController::class, 'destroy'])
        ->name('role.destroy');
});

