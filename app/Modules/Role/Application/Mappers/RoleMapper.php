<?php

namespace App\Modules\Role\Application\Mappers;

use App\Modules\Role\Application\DTOs\RoleDTO;
use App\Modules\Role\Domain\Entities\RoleEntity;

class RoleMapper
{

    // Convierte una entidad de dominio a DTO.
    public static function toDTO(RoleEntity $roleEntity): RoleDTO
    {
        return new RoleDTO(
            id: $roleEntity->getId(),
            name: $roleEntity->getName(),
            description: $roleEntity->getDescription(),
            status: $roleEntity->getStatus(),
            createdAt: $roleEntity->getCreatedAt(),
            updatedAt: $roleEntity->getUpdatedAt(),
        );
    }

    // Convierte un array de entidades a array de DTOs.
    public static function toDTOArray(array $entities): array
    {
        return array_map(fn($entity) => self::toDTO($entity), $entities);
    }
}

