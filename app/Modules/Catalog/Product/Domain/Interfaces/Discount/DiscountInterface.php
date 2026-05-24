<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces\Discount;

use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;

interface DiscountInterface
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Métodos de lectura de descuentos
    //--------------------------------------------------------------------------
    public function findCurrentByProductId(int $productId): ?DiscountEntity;

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Métodos de escritura de descuentos
    //--------------------------------------------------------------------------
    public function save(DiscountEntity $discountEntity): void;
}
