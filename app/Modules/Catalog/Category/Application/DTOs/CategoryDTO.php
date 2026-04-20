<?php

namespace App\Modules\Catalog\Category\Application\DTOs;

class CategoryDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $status,
    ) {}
}
