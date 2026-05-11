<?php

namespace App\Modules\Catalog\Product\Application\DTOs;

use Illuminate\Http\UploadedFile;

class ImageInputDTO
{
    public function __construct(
        public UploadedFile $file,
        public string $type,
    ) {}
}

