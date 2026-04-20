<?php

namespace App\Modules\Catalog\Brand\Application\DTOs;

class BrandDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $status,
    ) {}
}