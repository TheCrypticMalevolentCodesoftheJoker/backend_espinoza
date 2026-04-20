<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Product\Domain\Entities\DimensionEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\DimensionInterface;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblDimension;

class EloquentDimensionRepository implements DimensionInterface
{
    public function save(DimensionEntity $dimensionEntity): void
    {
        TblDimension::create([
            'product_id' => $dimensionEntity->getProductId(),
            'length' => $dimensionEntity->getLength(),
            'width' => $dimensionEntity->getWidth(),
            'thickness' => $dimensionEntity->getThickness(),
        ]);
    }
}
