<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces\Image;

use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;

interface ImageInterface
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Métodos de lectura de imágenes
    //--------------------------------------------------------------------------
    public function findByProductId(int $productId): array;

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Métodos de escritura y eliminación de imágenes
    //--------------------------------------------------------------------------
    public function save(ImageEntity $image): int;
    public function deleteByProductId(int $productId): void;
}
