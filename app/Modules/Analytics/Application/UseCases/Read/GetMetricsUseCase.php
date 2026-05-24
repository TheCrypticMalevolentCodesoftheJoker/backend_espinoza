<?php

namespace App\Modules\Analytics\Application\UseCases\Read;

use App\Modules\Analytics\Domain\Interfaces\AnalyticsInterface;

class GetMetricsUseCase
{
    //--------------------------------------------------------------------------
    // CONSTRUCTOR -> Inicializa el caso de uso con el repositorio
    //--------------------------------------------------------------------------
    public function __construct(
        private AnalyticsInterface $analyticsRepository,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUCIÓN -> Obtiene y unifica las métricas y top de productos
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
