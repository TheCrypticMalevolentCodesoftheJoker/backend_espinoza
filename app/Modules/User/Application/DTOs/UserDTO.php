<?php

namespace App\Modules\User\Application\DTOs;

class UserDTO
{
    public function __construct(
        public int $id,
        public int $roleId,
        public string $roleName,
        public string $name,
        public string $email,
        public string $password,
        public bool $status,
        public ?\DateTime $createdAt,
        public ?\DateTime $updatedAt,
    ) {}
}
