<?php

namespace App\Modules\Role\Application\DTOs;

class RoleDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $description,
        public bool $status,
        public ?\DateTime $createdAt,
        public ?\DateTime $updatedAt,
    ) {}
}
