<?php

namespace App\Modules\Analytics\Infrastructure\Persistence\Repositories;

use App\Modules\Analytics\Domain\Entities\ArEventEntity;
use App\Modules\Analytics\Domain\Interfaces\AnalyticsInterface;
use App\Modules\Analytics\Infrastructure\Persistence\Models\TblArEvent;

class EloquentAnalyticsRepository implements AnalyticsInterface
{
    //--------------------------------------------------------------------------
    // ESCRITURA -> Guardar evento de analítica
    //--------------------------------------------------------------------------
    public function save(ArEventEntity $eventEntity): void
    {
        TblArEvent::create([
            'session_id'       => $eventEntity->getSessionId(),
            'product_id'       => $eventEntity->getProductId(),
            'event_type'       => $eventEntity->getEventType(),
            'duration_seconds' => $eventEntity->getDurationSeconds(),
        ]);
    }

    //--------------------------------------------------------------------------
    // LECTURA -> Obtener métricas agregadas
    //--------------------------------------------------------------------------
    public function getMetricsSummary(?string $startDate, ?string $endDate, ?int $productId): array
    {
        $query = TblArEvent::query()
            ->selectRaw("
                COUNT(CASE WHEN event_type = 'ar_session_started' THEN 1 END) as total_visualizations,
                COUNT(CASE WHEN event_type = 'ar_mode_entered' THEN 1 END) as total_ar_activations,
                AVG(CASE WHEN event_type = 'ar_session_ended' THEN duration_seconds END) as average_duration
            ");

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }
        if ($productId) {
            $query->where('product_id', $productId);
        }

        $result = $query->first();

        $totalVisualizations = (int) ($result->total_visualizations ?? 0);
        $totalArActivations  = (int) ($result->total_ar_activations ?? 0);
        $averageDuration     = (float) ($result->average_duration ?? 0);

        $arConversionRate = $totalVisualizations > 0
            ? round(($totalArActivations / $totalVisualizations) * 100, 1)
            : 0;

        return [
            'total_visualizations'     => $totalVisualizations,
            'total_ar_activations'     => $totalArActivations,
            'ar_conversion_rate'       => $arConversionRate . '%',
            'average_duration_seconds' => round($averageDuration),
        ];
    }

    //--------------------------------------------------------------------------
    // LECTURA -> Obtener ranking de productos más visualizados
    //--------------------------------------------------------------------------
    public function getTopProductsAr(?string $startDate, ?string $endDate, int $limit = 5): array
    {
        $query = TblArEvent::query()
            ->selectRaw('product_id, count(*) as ar_views')
            ->where('event_type', 'ar_session_started')
            ->groupBy('product_id')
            ->orderByDesc('ar_views')
            ->limit($limit);

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

        $results = $query->with('tbl_product:id,name')->get();

        return $results->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'name'       => $item->tbl_product ? $item->tbl_product->name : 'Producto no encontrado',
                'ar_views'   => $item->ar_views,
            ];
        })->toArray();
    }
}
