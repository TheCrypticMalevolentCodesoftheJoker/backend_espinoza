<?php

//--------------------------------------------------------------------------
// GetMetricsUseCase: Consulta y consolidación de métricas de interacción AR
//--------------------------------------------------------------------------

namespace App\Modules\Analytics\Application\UseCases\Read;

use App\Modules\Analytics\Domain\Interfaces\AnalyticsInterface;

class GetMetricsUseCase
{
    public function __construct(
        private AnalyticsInterface $analyticsRepository,
    ) {}

    //--------------------------------------------------------------------------
    // Cálculo: Consolidación y procesamiento de métricas agregadas
    //--------------------------------------------------------------------------
    public function execute(?string $startDate, ?string $endDate, ?int $productId): array
    {
        $summary = $this->analyticsRepository->getMetricsSummary($startDate, $endDate, $productId);
        $topProducts = $this->analyticsRepository->getTopProductsAr($startDate, $endDate);

        return [
            'summary'         => $summary,
            'top_products_ar' => $topProducts,
        ];
    }
}
