<?php

namespace App\Modules\Role\Application\DTOs\Write;

class UpdateRoleDTO
{
    public function __construct(
        public string $name,
    ) {}
}
