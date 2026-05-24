<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Gateways;

use App\Modules\Catalog\Brand\Infrastructure\Persistence\Models\TblBrand;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\BrandAccessGateway;

class EloquentBrandAccessRepository implements BrandAccessGateway
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Verificación y lectura de marcas asociadas
    //--------------------------------------------------------------------------
    public function exists(int $brandId): bool
    {
        return TblBrand::where('id', $brandId)->exists();
    }

    public function findById(int $brandId): ?array
    {
        $brand = TblBrand::find($brandId, ['id', 'name']);

        if (!$brand) {
            return null;
        }

        return [
            'id'   => $brand->id,
            'name' => $brand->name,
        ];
    }

    public function findByIds(array $brandIds): array
    {
        return TblBrand::whereIn('id', $brandIds)
            ->get(['id', 'name'])
            ->keyBy('id')
            ->map(fn($r) => [
                'id'   => $r->id,
                'name' => $r->name,
            ])
            ->toArray();
    }
}
