<?php

namespace App\Modules\Catalog\Brand\Application\Mappers;

use App\Modules\Catalog\Brand\Application\DTOs\BrandDTO;
use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;

class BrandMapper
{
    public static function toDTO(BrandEntity $entity): BrandDTO
    {
        return new BrandDTO(
            id: $entity->getId(),
            name: $entity->getName(),
            status: $entity->getStatus(),
        );
    }

    public static function toDTOArray(array $entities): array
    {
        return array_map(fn($entity) => self::toDTO($entity), $entities);
    }
}
