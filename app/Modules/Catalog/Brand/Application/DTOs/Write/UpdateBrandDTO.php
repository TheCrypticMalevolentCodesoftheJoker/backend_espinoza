<?php

namespace App\Modules\Catalog\Brand\Application\DTOs\Write;

class UpdateBrandDTO
{
    public function __construct(
        public string $name
    ) {}
}

