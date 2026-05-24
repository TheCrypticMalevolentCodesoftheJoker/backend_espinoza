<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces\Gateways;

interface CategoryAccessGateway
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Métodos de consulta de categorías
    //--------------------------------------------------------------------------
    public function exists(int $id): bool;

    public function findById(int $id): ?array;

    public function findByIds(array $ids): array;
}
