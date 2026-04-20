<?php

namespace App\Modules\Catalog\Category\Application\Mappers;

use App\Modules\Catalog\Category\Application\DTOs\CategoryDTO;
use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;

class CategoryMapper
{
    
    // Convierte una entidad de dominio a DTO.
    public static function toDTO(CategoryEntity $categoryEntity): CategoryDTO
    {
        return new CategoryDTO(
            id: $categoryEntity->getId(),
            name: $categoryEntity->getName(),
            status: $categoryEntity->getStatus(),
        );
    }

    // Convierte un array de entidades a array de DTOs.
    public static function toDTOArray(array $entities): array
    {
        return array_map(fn($entity) => self::toDTO($entity), $entities);
    }
}
