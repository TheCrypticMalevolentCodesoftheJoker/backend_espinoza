<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces;

use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;

interface DiscountInterface
{
    public function save(DiscountEntity $discountEntity): void;
}
