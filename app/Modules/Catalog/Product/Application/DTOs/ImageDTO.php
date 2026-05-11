<?php

namespace App\Modules\Catalog\Product\Application\DTOs;

class ImageDTO
{
    public function __construct(
        public int $id,
        public string $path,
        public string $url,
        public string $type,
    ) {}
}

