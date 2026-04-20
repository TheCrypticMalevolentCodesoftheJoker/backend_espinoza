<?php

namespace App\Modules\Catalog\Product\Application\Queries;

use App\Modules\Catalog\Product\Application\DTOs\Product\ProductDetailDTO;

interface ProductReadRepository
{
    public function findAll(): array;
    public function findById(string $id): ?ProductDetailDTO;
}