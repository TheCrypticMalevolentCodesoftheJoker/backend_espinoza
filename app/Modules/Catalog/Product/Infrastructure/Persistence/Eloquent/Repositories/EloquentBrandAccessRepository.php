<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Product\Domain\Interfaces\BrandAccessGateway;
use Illuminate\Support\Facades\DB;

class EloquentBrandAccessRepository implements BrandAccessGateway
{
    //--------------------------------------------------------------------------
    // REPOSITORIO -> Acceso a Marcas
    //--------------------------------------------------------------------------

    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function exists(int $id): bool
    {
        return DB::table('tbl_brand')
            ->where('id', $id)
            ->where('status', true)
            ->exists();
    }

    public function findByIds(array $ids): array
    {
        return DB::table('tbl_brand')
            ->whereIn('id', $ids)
            ->get(['id', 'name'])
            ->keyBy('id')
            ->map(fn($row) => ['id' => $row->id, 'name' => $row->name])
            ->toArray();
    }

    public function findAllActive(): array
    {
        return DB::table('tbl_brand')
            ->where('status', true)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn($row) => ['id' => $row->id, 'name' => $row->name])
            ->toArray();
    }
}

