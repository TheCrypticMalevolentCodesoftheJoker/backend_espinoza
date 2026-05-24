<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Analytics\Presentation\Controllers\AnalyticsController;

//--------------------------------------------------------------------------
// PÚBLICO -> Capturar eventos
//--------------------------------------------------------------------------
Route::post('events', [AnalyticsController::class, 'store'])
    ->name('analytics.events.store');

//--------------------------------------------------------------------------
// PROTEGIDO -> Obtener métricas para administrador/gerencia
//--------------------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::get('events', [AnalyticsController::class, 'metrics'])->name('admin.metrics');
});
