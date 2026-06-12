<?php

//--------------------------------------------------------------------------
// StoreImageDTO: DTO para la carga e inserción de imágenes de productos
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Application\DTOs\Write\Image;

use App\Modules\Catalog\Product\Domain\ValueObjects\Image\ProductFile;

class StoreImageDTO
{
    public function __construct(
        public ProductFile $file,
    ) {}
}
