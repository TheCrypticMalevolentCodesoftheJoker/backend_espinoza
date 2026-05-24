<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Image;

use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\Image\ImageInterface;
use App\Modules\Catalog\Product\Domain\ValueObjects\Image\ImageType;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Models\TblImage;

class EloquentImageRepository implements ImageInterface
{
    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener imágenes de un producto por ID
    //--------------------------------------------------------------------------
    public function findByProductId(int $productId): array
    {
        return TblImage::where('product_id', $productId)
            ->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Guardar una nueva imagen de producto
    //--------------------------------------------------------------------------
    public function save(ImageEntity $imageEntity): int
    {
        $model = TblImage::create([
            'product_id' => $imageEntity->getProductId(),
            'url'        => $imageEntity->getUrl(),
            'type'       => $imageEntity->getType()->category(),
        ]);

        return $model->id;
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Eliminar imágenes asociadas a un producto
    //--------------------------------------------------------------------------
    public function deleteByProductId(int $productId): void
    {
        TblImage::where('product_id', $productId)->delete();
    }

    //--------------------------------------------------------------------------
    // MÉTODOS PRIVADOS -> Mapeo de persistencia a dominio
    //--------------------------------------------------------------------------
    private function mapToEntity($model): ImageEntity
    {
        return ImageEntity::reconstitute(
            id: $model->id,
            productId: $model->product_id,
            url: $model->url,
            type: new ImageType($model->type)
        );
    }
}
