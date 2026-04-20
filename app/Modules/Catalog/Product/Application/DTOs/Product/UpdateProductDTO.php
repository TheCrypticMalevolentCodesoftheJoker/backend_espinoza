<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Product;

class UpdateProductDTO
{
    public function __construct(
        // -------------------------
        // PRODUCTO BASE
        // -------------------------
        public string $code,
        public int $category_id,
        public int $brand_id,
        public string $name,
        public ?string $description,
        public string $unit_measure,
        public int $stock,
        public bool $status,

        // -------------------------
        // RELACIONES COMPLEJAS
        // -------------------------
        public array $images,
        public array $price,
        public ?array $discount,
        public array $dimension,
    ) {}
}
