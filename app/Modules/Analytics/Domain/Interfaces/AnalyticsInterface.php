<?php

namespace App\Modules\Analytics\Domain\Interfaces;

use App\Modules\Analytics\Domain\Entities\ArEventEntity;

interface AnalyticsInterface
{
    //--------------------------------------------------------------------------
    // ESCRITURA -> Persistir eventos de analítica
    //--------------------------------------------------------------------------
    public function save(ArEventEntity $event): void;

    //--------------------------------------------------------------------------
    // LECTURA -> Obtener métricas de negocio generales y rankings
    //--------------------------------------------------------------------------
    public function getMetricsSummary(?string $startDate, ?string $endDate, ?int $productId): array;

    public function getTopProductsAr(?string $startDate, ?string $endDate, int $limit = 5): array;
}
