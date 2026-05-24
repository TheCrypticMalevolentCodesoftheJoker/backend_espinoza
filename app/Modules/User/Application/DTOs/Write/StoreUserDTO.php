<?php

namespace App\Modules\User\Application\DTOs\Write;

class StoreUserDTO
{
    public function __construct(
        public int $roleId,
        public string $name,
        public string $email,
        public string $password
    ) {}
}
