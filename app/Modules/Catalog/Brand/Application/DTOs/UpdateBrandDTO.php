<?php

namespace App\Modules\Catalog\Brand\Application\DTOs;

class UpdateBrandDTO
{
    public function __construct(
        public string $name
    ) {}
}
