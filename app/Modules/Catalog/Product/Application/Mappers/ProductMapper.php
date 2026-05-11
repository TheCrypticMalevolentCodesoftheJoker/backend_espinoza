<?php

namespace App\Modules\Catalog\Product\Application\Mappers;

use App\Modules\Catalog\Product\Application\DTOs\DiscountDTO;
use App\Modules\Catalog\Product\Application\DTOs\ImageDTO;
use App\Modules\Catalog\Product\Application\DTOs\PriceDTO;
use App\Modules\Catalog\Product\Application\DTOs\ProductDTO;
use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;
use Illuminate\Support\Facades\Storage;

class ProductMapper
{
    //--------------------------------------------------------------------------
    // MAPEOS
    //--------------------------------------------------------------------------
    public static function toDTO(ProductEntity $entity, string $categoryName, string $brandName): ProductDTO
    {
        $images = array_map(
            fn($image) => new ImageDTO(
                id: $image->getId(),
                path: $image->getPath(),
                url: Storage::disk('public')->url($image->getPath()),
                type: $image->getType(),
            ),
            $entity->getImages()
        );

        $priceDTO = null;
        if ($price = $entity->getCurrentPrice()) {
            $priceDTO = new PriceDTO(
                id: $price->getId(),
                amount: $price->getAmount(),
                startDate: $price->getStartDate(),
                endDate: $price->getEndDate(),
                status: $price->getStatus(),
            );
        }

        $discountDTO = null;
        if ($discount = $entity->getCurrentDiscount()) {
            $discountDTO = new DiscountDTO(
                id: $discount->getId(),
                amount: $discount->getAmount(),
                startDate: $discount->getStartDate(),
                endDate: $discount->getEndDate(),
                status: $discount->getStatus(),
            );
        }

        return new ProductDTO(
            id: $entity->getId(),
            categoryId: $entity->getCategoryId(),
            categoryName: $categoryName,
            brandId: $entity->getBrandId(),
            brandName: $brandName,
            code: $entity->getCode(),
            name: $entity->getName(),
            description: $entity->getDescription(),
            unitMeasure: $entity->getUnitMeasure(),
            length: $entity->getLength(),
            width: $entity->getWidth(),
            thickness: $entity->getThickness(),
            stock: $entity->getStock(),
            status: $entity->getStatus(),
            images: $images,
            currentPrice: $priceDTO,
            currentDiscount: $discountDTO,
            createdAt: $entity->getCreatedAt(),
            updatedAt: $entity->getUpdatedAt(),
        );
    }
}

