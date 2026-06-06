<?php

//--------------------------------------------------------------------------
// BrandMapper: Transformación bidireccional entre la entidad BrandEntity y sus DTOs
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Application\Mappers;

use App\Modules\Catalog\Brand\Application\DTOs\Read\BrandDTO;
use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;

class BrandMapper
{
    public static function toDTO(BrandEntity $brandEntity): BrandDTO
    {
        return new BrandDTO(
            id: $brandEntity->getId(),
            name: $brandEntity->getName(),
            status: $brandEntity->getStatus(),
            createdAt: $brandEntity->getCreatedAt()?->format('Y-m-d H:i:s'),
            updatedAt: $brandEntity->getUpdatedAt()?->format('Y-m-d H:i:s'),
        );
    }

    public static function toDTOArray(array $entities): array
    {
        return array_map(fn($entity) => self::toDTO($entity), $entities);
    }
}
