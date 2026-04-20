<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Dimension;

class StoreDimensionDTO
{
    public function __construct(
        public string $length,
        public string $width,
        public string $thickness
    ) {}
}
