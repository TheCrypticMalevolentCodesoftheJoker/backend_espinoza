<?php

namespace App\Modules\Catalog\Product\Application\DTOs;

class ProductSummaryDTO
{
    public function __construct(
        public int $id,
        public string $code,
        public string $name,
        public string $categoryName,
        public string $brandName,
        public bool $status,
        public ?float $currentPrice,
        public ?string $mainImageUrl,
    ) {}
}

