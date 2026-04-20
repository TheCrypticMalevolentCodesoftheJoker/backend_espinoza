<?php

namespace App\Modules\Catalog\Product\Application\Mappers;

use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;
use App\Modules\Catalog\Product\Application\DTOs\Product\ProductDTO;

class ProductMapper
{
    // Convierte una entidad de dominio a DTO.
    public static function toDTO(ProductEntity $productEntity): ProductDTO
    {
        return new ProductDTO(
            id: $productEntity->getId(),
            code: $productEntity->getCode(),
            category_id: $productEntity->getCategoryId(),
            category_name: $model->tbl_category->name ?? '',
            brand_id: $productEntity->getBrandId(),
            brand_name: $model->tbl_brand->name ?? '',
            name: $productEntity->getName(),
            description: $productEntity->getDescription(),
            unit_measure: $productEntity->getUnitMeasure(),
            stock: $productEntity->getStock(),
            status: $productEntity->getStatus(),
        );
    }

    // Convierte un array de entidades a array de DTOs.
    public static function toDTOArray(array $entities): array
    {
        return array_map(fn($entity) => self::toDTO($entity), $entities);
    }
}
