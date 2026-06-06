<?php

//--------------------------------------------------------------------------
// AnalyticsInterface: Contrato para operaciones de lectura y escritura de eventos AR
//--------------------------------------------------------------------------

namespace App\Modules\Analytics\Domain\Interfaces;

use App\Modules\Analytics\Domain\Entities\ArEventEntity;

interface AnalyticsInterface
{
    public function save(ArEventEntity $event): void;

    public function getMetricsSummary(?string $startDate, ?string $endDate, ?int $productId): array;

    public function getTopProductsAr(?string $startDate, ?string $endDate, int $limit = 5): array;
}
