<?php

namespace App\Modules\Catalog\Product\Application\DTOs;

class UpdateProductDTO
{
    public function __construct(
        public ?int $categoryId,
        public ?int $brandId,
        public ?string $code,
        public ?string $name,
        public ?string $description,
        public ?string $unitMeasure,
        public ?string $length,
        public ?string $width,
        public ?string $thickness,
        public ?int $stock,

        public ?array $images,
        public bool $replaceImages,
        public ?StorePriceDTO $price,
        public ?StoreDiscountDTO $discount,
    ) {}
}

