<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Product;

use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\Product\ProductInterface;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductName;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductLength;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductWidth;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductThickness;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductStock;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Models\TblProduct;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository implements ProductInterface
{
    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener todos los productos
    //--------------------------------------------------------------------------
    public function findAll(): array
    {
        return TblProduct::all()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener productos activos
    //--------------------------------------------------------------------------
    public function findActive(): array
    {
        return TblProduct::where('status', true)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener producto por ID
    //--------------------------------------------------------------------------
    public function findById(int $id): ?ProductEntity
    {
        $model = TblProduct::find($id);

        if (!$model) {
            return null;
        }

        return $this->mapToEntity($model);
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener producto por nombre
    //--------------------------------------------------------------------------
    public function findByName(string $name): ?ProductEntity
    {
        $model = TblProduct::where('name', $name)->first();

        if (!$model) {
            return null;
        }

        return $this->mapToEntity($model);
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Guardar un nuevo producto
    //--------------------------------------------------------------------------
    public function save(ProductEntity $productEntity): int
    {
        return DB::transaction(function () use ($productEntity) {
            $model = TblProduct::create([
                'code'         => $productEntity->getCode(),
                'category_id'  => $productEntity->getCategoryId(),
                'brand_id'     => $productEntity->getBrandId(),
                'name'         => $productEntity->getName(),
                'description'  => $productEntity->getDescription(),
                'length'       => $productEntity->getLength(),
                'width'        => $productEntity->getWidth(),
                'thickness'    => $productEntity->getThickness(),
                'stock'        => $productEntity->getStock(),
                'status'       => $productEntity->getStatus(),
            ]);
            return $model->id;
        });
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Actualizar producto existente
    //--------------------------------------------------------------------------
    public function update(ProductEntity $productEntity): void
    {
        TblProduct::where('id', $productEntity->getId())->update([
            'code'         => $productEntity->getCode(),
            'category_id'  => $productEntity->getCategoryId(),
            'brand_id'     => $productEntity->getBrandId(),
            'name'         => $productEntity->getName(),
            'description'  => $productEntity->getDescription(),
            'length'       => $productEntity->getLength(),
            'width'        => $productEntity->getWidth(),
            'thickness'    => $productEntity->getThickness(),
            'stock'        => $productEntity->getStock(),
            'status'       => $productEntity->getStatus(),
        ]);
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Eliminar producto por ID
    //--------------------------------------------------------------------------
    public function delete(int $id): void
    {
        TblProduct::destroy($id);
    }

    //--------------------------------------------------------------------------
    // MÉTODOS PRIVADOS -> Mapeo de persistencia a dominio
    //--------------------------------------------------------------------------
    private function mapToEntity($model): ProductEntity
    {
        return ProductEntity::reconstitute(
            id: $model->id,
            code: $model->code,
            categoryId: $model->category_id,
            brandId: $model->brand_id,
            name: new ProductName($model->name),
            description: $model->description,
            length: new ProductLength($model->length),
            width: new ProductWidth($model->width),
            thickness: new ProductThickness($model->thickness),
            stock: new ProductStock($model->stock),
            status: (bool) $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        );
    }
}
