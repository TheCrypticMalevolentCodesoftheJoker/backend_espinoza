<?php

namespace App\Modules\User\Application\DTOs\Read;

class UserDTO
{
    public function __construct(
        public int $id,
        public int $roleId,
        public string $roleName,
        public string $name,
        public string $email,
        public bool $status,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}
}
