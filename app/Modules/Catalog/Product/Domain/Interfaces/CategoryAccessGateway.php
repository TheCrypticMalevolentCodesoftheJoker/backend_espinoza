<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces;

interface CategoryAccessGateway
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------

    public function exists(int $id): bool;

    public function findByIds(array $ids): array;

    public function findAllActive(): array;
}

