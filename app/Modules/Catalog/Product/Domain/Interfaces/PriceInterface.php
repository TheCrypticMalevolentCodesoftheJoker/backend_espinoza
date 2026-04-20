<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces;

use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;

interface PriceInterface
{
    public function save(PriceEntity $priceEntity): void;
}
