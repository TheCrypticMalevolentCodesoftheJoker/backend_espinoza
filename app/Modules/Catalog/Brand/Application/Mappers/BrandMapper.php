<?php

namespace App\Modules\Catalog\Brand\Application\Mappers;

use App\Modules\Catalog\Brand\Application\DTOs\BrandDTO;
use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;

class BrandMapper
{

    // Convierte una entidad de dominio a DTO.
    public static function toDTO(BrandEntity $brandEntity): BrandDTO
    {
        return new BrandDTO(
            id: $brandEntity->getId(),
            name: $brandEntity->getName(),
            status: $brandEntity->getStatus(),
            createdAt: $brandEntity->getCreatedAt(),
            updatedAt: $brandEntity->getUpdatedAt(),
        );
    }

    // Convierte un array de entidades a array de DTOs.
    public static function toDTOArray(array $entities): array
    {
        return array_map(fn($entity) => self::toDTO($entity), $entities);
    }
}

