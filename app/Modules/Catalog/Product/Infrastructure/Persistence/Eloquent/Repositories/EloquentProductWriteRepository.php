<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\ProductInterface;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblProduct;

class EloquentProductWriteRepository implements ProductInterface
{
    /*----------------------------------------------------------------------------------
    GUARDAR CATEGORÍA
    ----------------------------------------------------------------------------------*/
    public function save(ProductEntity $product): ProductEntity
    {
        $model = TblProduct::create([
            'code' => $product->getCode(),
            'category_id' => $product->getCategoryId(),
            'brand_id' => $product->getBrandId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'unit_measure' => $product->getUnitMeasure(),
            'stock' => $product->getStock(),
            'status' => $product->getStatus(),
        ]);

        return ProductEntity::reconstitute(
            id: $model->id,
            code: $model->code,
            categoryId: $model->category_id,
            brandId: $model->brand_id,
            name: $model->name,
            description: $model->description,
            unitMeasure: $model->unit_measure,
            stock: $model->stock,
            status: $model->status
        );
    }
}
