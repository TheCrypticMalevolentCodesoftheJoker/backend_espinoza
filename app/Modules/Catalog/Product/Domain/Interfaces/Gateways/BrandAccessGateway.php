<?php

//--------------------------------------------------------------------------
// BrandAccessGateway: Contrato para el acceso a datos externos del módulo de marcas
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Interfaces\Gateways;

interface BrandAccessGateway
{
    public function exists(int $id): bool;

    public function findById(int $id): ?array;

    public function findByIds(array $ids): array;
}
