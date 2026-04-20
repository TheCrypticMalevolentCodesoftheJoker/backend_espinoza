<?php

namespace App\Modules\Catalog\Product\Application\DTOs;

use App\Modules\Catalog\Product\Application\DTOs\Dimension\StoreDimensionDTO;
use App\Modules\Catalog\Product\Application\DTOs\Discount\StoreDiscountDTO;
use App\Modules\Catalog\Product\Application\DTOs\Price\StorePriceDTO;
use App\Modules\Catalog\Product\Application\DTOs\Product\StoreProductDTO;

class ProductAssetsDTO
{
    public function __construct(
        public StoreProductDTO $storeProductDTO,
        public array $images,
        public StorePriceDTO $storePriceDTO,
        public ?StoreDiscountDTO $storeDiscountDTO,
        public StoreDimensionDTO $storeDimensionDTO,
    ) {}
}
