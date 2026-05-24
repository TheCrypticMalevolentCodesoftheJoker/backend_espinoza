<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Write\Image;

use Illuminate\Http\UploadedFile;

class StoreImageDTO
{
    public function __construct(
        public UploadedFile $file,
    ) {}
}
