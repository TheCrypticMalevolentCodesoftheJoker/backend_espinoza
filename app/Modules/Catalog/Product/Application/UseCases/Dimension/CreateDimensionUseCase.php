<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Dimension;

use App\Modules\Catalog\Product\Application\DTOs\Dimension\StoreDimensionDTO;
use App\Modules\Catalog\Product\Domain\Entities\DimensionEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\DimensionInterface;

class CreateDimensionUseCase
{
    public function __construct(
        private DimensionInterface $dimensionInterface,
    ) {}

    public function execute(int $productId, StoreDimensionDTO $storeDimensionDTO): void
    {
        $dimension = DimensionEntity::create(
            productId: $productId,
            length: $storeDimensionDTO->length,
            width: $storeDimensionDTO->width,
            thickness: $storeDimensionDTO->thickness
        );
        $this->dimensionInterface->save($dimension);
    }
}
