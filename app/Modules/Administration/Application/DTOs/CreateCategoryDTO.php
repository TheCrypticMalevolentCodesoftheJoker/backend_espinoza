<?php

namespace App\Modules\Administration\Application\DTOs;

class CreateCategoryDTO
{
    public function __construct(
        public string $name
    ) {}
}
