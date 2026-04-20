<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces;

use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;

interface ProductInterface
{
    public function save(ProductEntity $product): ProductEntity;
}
