<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces;

use App\Modules\Catalog\Product\Domain\Entities\DimensionEntity;;

interface DimensionInterface
{
    public function save(DimensionEntity $dimensionEntity): void;
}
