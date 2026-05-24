<?php

namespace App\Modules\User\Application\DTOs\Read;

class UserRoleDTO
{
    public function __construct(
        public int $id,
        public string $name
    ) {}
}
