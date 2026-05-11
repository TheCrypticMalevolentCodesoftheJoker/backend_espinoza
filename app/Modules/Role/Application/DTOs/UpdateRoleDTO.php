<?php

namespace App\Modules\Role\Application\DTOs;

class UpdateRoleDTO
{
    public function __construct(
        public string $name,
        public ?string $description,
    ) {}
}
