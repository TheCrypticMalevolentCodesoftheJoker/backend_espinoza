<?php

namespace App\Modules\User\Application\Mappers;

use App\Modules\User\Application\DTOs\Read\UserRoleDTO;

class UserRoleMapper
{
    public static function toDTO(array $role): UserRoleDTO
    {
        return new UserRoleDTO(
            id: $role['id'],
            name: $role['name']
        );
    }

    public static function toDTOArray(array $roles): array
    {
        return array_map(
            fn($role) => self::toDTO($role),
            $roles
        );
    }
}
