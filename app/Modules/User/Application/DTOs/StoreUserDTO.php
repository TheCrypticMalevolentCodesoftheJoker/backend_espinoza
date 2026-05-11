<?php

namespace App\Modules\User\Application\DTOs;

class StoreUserDTO
{
    public function __construct(
        public int $roleId,
        public string $name,
        public string $email,
        public string $password
    ) {}
}
