<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Image;

class StoreImageDTO
{
    public function __construct(
        public string $url,
        public string $type
    ) {}
}
