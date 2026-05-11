<?php

namespace App\Modules\Role\Application\DTOs;

class StoreRoleDTO
{
    public function __construct(
        public string $name,
        public ?string $description,
    ) {}
}
