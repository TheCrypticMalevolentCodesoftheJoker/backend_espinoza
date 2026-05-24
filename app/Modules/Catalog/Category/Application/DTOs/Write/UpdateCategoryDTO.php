<?php

namespace App\Modules\Catalog\Category\Application\DTOs\Write;

class UpdateCategoryDTO
{
    public function __construct(
        public string $name
    ) {}
}
