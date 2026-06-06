<?php

//--------------------------------------------------------------------------
// DiscountInterface: Contrato para la persistencia y consulta de descuentos de productos
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Interfaces\Discount;

use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;

interface DiscountInterface
{
    public function findCurrentByProductId(int $productId): ?DiscountEntity;

    public function save(DiscountEntity $discountEntity): void;
}
