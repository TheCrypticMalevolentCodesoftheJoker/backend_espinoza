<?php

//--------------------------------------------------------------------------
// PriceInterface: Contrato para la persistencia y consulta de precios de productos
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Interfaces\Price;

use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;

interface PriceInterface
{
    public function findCurrentByProductId(int $productId): ?PriceEntity;

    public function save(PriceEntity $priceEntity): void;
}
