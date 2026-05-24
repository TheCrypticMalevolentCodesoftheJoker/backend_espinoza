<?php

namespace App\Modules\Catalog\Brand\Application\DTOs\Read;

class BrandDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $status,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}
}
