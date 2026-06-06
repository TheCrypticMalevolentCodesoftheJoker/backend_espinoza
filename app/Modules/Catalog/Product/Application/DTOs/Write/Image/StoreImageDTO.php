<?php

//--------------------------------------------------------------------------
// StoreImageDTO: DTO para la carga e inserción de imágenes de productos
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Application\DTOs\Write\Image;

use Illuminate\Http\UploadedFile;

class StoreImageDTO
{
    public function __construct(
        public UploadedFile $file,
    ) {}
}
