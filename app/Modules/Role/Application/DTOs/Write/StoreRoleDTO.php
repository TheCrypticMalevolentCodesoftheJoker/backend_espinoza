<?php

namespace App\Modules\Role\Application\DTOs\Write;

class StoreRoleDTO
{
    public function __construct(
        public string $name,
    ) {}
}
