<?php

//--------------------------------------------------------------------------
// EloquentCategoryAccessRepository: Implementación Eloquent del adaptador para consultar datos de categorías
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Gateways;

use App\Modules\Catalog\Category\Infrastructure\Persistence\Models\TblCategory;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\CategoryAccessGateway;

class EloquentCategoryAccessRepository implements CategoryAccessGateway
{
    //--------------------------------------------------------------------------
    // Consulta: Comprobación de existencia y obtención de información de categorías
    //--------------------------------------------------------------------------
    public function exists(int $categoryId): bool
    {
        return TblCategory::where('id', $categoryId)->exists();
    }

    public function findById(int $categoryId): ?array
    {
        $category = TblCategory::find($categoryId, ['id', 'name']);

        if (!$category) {
            return null;
        }

        return [
            'id'   => $category->id,
            'name' => $category->name,
        ];
    }

    public function findByIds(array $categoryIds): array
    {
        return TblCategory::whereIn('id', $categoryIds)
            ->get(['id', 'name'])
            ->keyBy('id')
            ->map(fn($row) => [
                'id'   => $row->id,
                'name' => $row->name,
            ])
            ->toArray();
    }
}
