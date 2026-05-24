<?php

namespace App\Modules\Role\Application\DTOs\Read;

class RoleDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $status,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}
}
