<?php

//--------------------------------------------------------------------------
// ImageInterface: Contrato del repositorio para imágenes asociadas a productos
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Interfaces\Image;

use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;

interface ImageInterface
{
    public function findByProductId(int $productId): array;

    public function save(ImageEntity $image): int;
    public function deleteByProductId(int $productId): void;
}
