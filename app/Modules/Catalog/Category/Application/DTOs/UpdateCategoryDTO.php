<?php

namespace App\Modules\Catalog\Category\Application\DTOs;

class UpdateCategoryDTO
{
    public function __construct(
        public string $name
    ) {}
}
