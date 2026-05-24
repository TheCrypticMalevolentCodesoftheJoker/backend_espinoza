<?php

namespace App\Modules\Catalog\Category\Application\DTOs\Read;

class CategoryDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $status,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}
}
