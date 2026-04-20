<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Product;

class ProductDTO
{
    public function __construct(
        public int $id,
        public string $code,
        public int $category_id,
        public string $category_name,
        public int $brand_id,
        public string $brand_name,
        public string $name,
        public ?string $description,
        public string $unit_measure,
        public int $stock,
        public bool $status,
    ) {}
}
