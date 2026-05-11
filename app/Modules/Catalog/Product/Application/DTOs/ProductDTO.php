<?php

namespace App\Modules\Catalog\Product\Application\DTOs;

class ProductDTO
{
    public function __construct(
        public int $id,
        public int $categoryId,
        public string $categoryName,
        public int $brandId,
        public string $brandName,
        public string $code,
        public string $name,
        public ?string $description,
        public string $unitMeasure,
        public string $length,
        public string $width,
        public string $thickness,
        public int $stock,
        public bool $status,
        public array $images,
        public ?PriceDTO $currentPrice,
        public ?DiscountDTO $currentDiscount,
        public ?\DateTime $createdAt,
        public ?\DateTime $updatedAt,
    ) {}
}

