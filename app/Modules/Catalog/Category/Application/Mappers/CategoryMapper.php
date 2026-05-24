<?php

namespace App\Modules\Catalog\Category\Application\Mappers;

use App\Modules\Catalog\Category\Application\DTOs\Read\CategoryDTO;
use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;

class CategoryMapper
{
    public static function toDTO(CategoryEntity $categoryEntity): CategoryDTO
    {
        return new CategoryDTO(
            id: $categoryEntity->getId(),
            name: $categoryEntity->getName(),
            status: $categoryEntity->getStatus(),
            createdAt: $categoryEntity->getCreatedAt()?->format('Y-m-d H:i:s'),
            updatedAt: $categoryEntity->getUpdatedAt()?->format('Y-m-d H:i:s'),
        );
    }

    public static function toDTOArray(array $entities): array
    {
        return array_map(fn($entity) => self::toDTO($entity), $entities);
    }
}
