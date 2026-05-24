<?php

namespace App\Modules\Role\Application\Mappers;

use App\Modules\Role\Application\DTOs\Read\RoleDTO;
use App\Modules\Role\Domain\Entities\RoleEntity;

class RoleMapper
{
    public static function toDTO(RoleEntity $roleEntity): RoleDTO
    {
        return new RoleDTO(
            id: $roleEntity->getId(),
            name: $roleEntity->getName(),
            status: $roleEntity->getStatus(),
            createdAt: $roleEntity->getCreatedAt()?->format('Y-m-d H:i:s'),
            updatedAt: $roleEntity->getUpdatedAt()?->format('Y-m-d H:i:s'),
        );
    }

    public static function toDTOArray(array $entities): array
    {
        return array_map(fn($entity) => self::toDTO($entity), $entities);
    }
}
