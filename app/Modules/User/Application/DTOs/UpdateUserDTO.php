<?php

namespace App\Modules\User\Application\DTOs;

class UpdateUserDTO
{
    public function __construct(
        public int $roleId,
        public string $name,
        public string $email,
        public ?string $password = null
    ) {}
}
