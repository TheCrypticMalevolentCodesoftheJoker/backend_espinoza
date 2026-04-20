<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Product;

class StoreProductDTO
{
    public function __construct(
        public int $category_id,
        public int $brand_id,
        public string $name,
        public ?string $description,
        public string $unit_measure,
        public int $stock,
    ) {}
}
