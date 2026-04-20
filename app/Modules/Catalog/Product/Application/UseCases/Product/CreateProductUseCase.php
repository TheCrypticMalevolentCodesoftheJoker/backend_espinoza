<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Product;

use App\Modules\Catalog\Product\Application\DTOs\Product\ProductDTO;
use App\Modules\Catalog\Product\Application\DTOs\Product\StoreProductDTO;
use App\Modules\Catalog\Product\Application\Mappers\ProductMapper;
use App\Modules\Catalog\Product\Domain\Interfaces\ProductInterface;
use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;

class CreateProductUseCase
{
    public function __construct(
        private ProductInterface $productInterface
    ) {}

    public function execute(StoreProductDTO $storeProductDTO): ProductDTO
    {
        $product = ProductEntity::create(
            categoryId: $storeProductDTO->category_id,
            brandId: $storeProductDTO->brand_id,
            name: $storeProductDTO->name,
            description: $storeProductDTO->description,
            unitMeasure: $storeProductDTO->unit_measure,
            stock: $storeProductDTO->stock
        );

        $saved = $this->productInterface->save($product);

        return ProductMapper::toDTO($saved);
    }
}
