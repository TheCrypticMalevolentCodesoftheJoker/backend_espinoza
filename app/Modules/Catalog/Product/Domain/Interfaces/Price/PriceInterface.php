<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces\Price;

use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;

interface PriceInterface
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Métodos de lectura de precios
    //--------------------------------------------------------------------------
    public function findCurrentByProductId(int $productId): ?PriceEntity;

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Métodos de escritura de precios
    //--------------------------------------------------------------------------
    public function save(PriceEntity $priceEntity): void;
}
