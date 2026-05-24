<?php

namespace App\Modules\Analytics\Presentation\Controllers;

use App\Modules\Analytics\Application\UseCases\Write\CreateArEventUseCase;
use App\Modules\Analytics\Application\UseCases\Read\GetMetricsUseCase;
use App\Modules\Analytics\Presentation\Requests\StoreArEventRequest;
use App\Shared\Responses\ApiResponse;
use Illuminate\Http\Request;

class AnalyticsController
{
    public function __construct(
        private readonly CreateArEventUseCase $createArEventUseCase,
        private readonly GetMetricsUseCase $getMetricsUseCase,
    ) {}

    //--------------------------------------------------------------------------
    // ESCRITURA -> Registrar un evento de interacción AR
    //--------------------------------------------------------------------------
    public function store(StoreArEventRequest $request)
    {
        $this->createArEventUseCase->execute($request->toDto());

        return ApiResponse::success(
            statusCode: 201,
            message: 'Evento registrado correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // LECTURA -> Obtener métricas agregadas del visualizador AR
    //--------------------------------------------------------------------------
    public function metrics(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $productId = $request->query('product_id') ? (int) $request->query('product_id') : null;

        $metrics = $this->getMetricsUseCase->execute($startDate, $endDate, $productId);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Métricas obtenidas correctamente.',
            data: $metrics
        );
    }
}
