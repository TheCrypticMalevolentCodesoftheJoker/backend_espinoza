<?php

//--------------------------------------------------------------------------
// router.php: Definición de endpoints HTTP del módulo de Analytics
//--------------------------------------------------------------------------

use Illuminate\Support\Facades\Route;
use App\Modules\Analytics\Presentation\Controllers\AnalyticsController;

Route::post('events', [AnalyticsController::class, 'store'])
    ->name('analytics.events.store');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('events', [AnalyticsController::class, 'metrics'])->name('admin.metrics');
});
