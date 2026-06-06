<?php

//--------------------------------------------------------------------------
// UpdateProductDTO: DTO para la actualización de atributos y datos de un producto existente
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Application\DTOs\Write\Product;

use App\Modules\Catalog\Product\Application\DTOs\Write\Discount\StoreDiscountDTO;
use App\Modules\Catalog\Product\Application\DTOs\Write\Price\StorePriceDTO;

class UpdateProductDTO
{
    public function __construct(
        public ?int $categoryId,
        public ?int $brandId,
        public ?string $name,
        public ?string $description,
        public ?string $length,
        public ?string $width,
        public ?string $thickness,
        public ?int $stock,
        public ?bool $replaceImages,
        public array $images = [],
        public ?StorePriceDTO $price,
        public ?StoreDiscountDTO $discount,
    ) {}
}
