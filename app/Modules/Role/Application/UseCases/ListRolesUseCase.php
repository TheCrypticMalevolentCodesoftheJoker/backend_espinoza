<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Application\DTOs\RoleDTO;
use App\Modules\Role\Domain\Interfaces\RoleInterface;

class ListRolesUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    public function execute(): array
    {
        $roles = $this->roleInterface->findAll();
        $total = $this->roleInterface->countAll();
        $activos = $this->roleInterface->countActive();
        $inactivos = $this->roleInterface->countInactive();

        $dto = array_map(function ($role) {
            return new RoleDTO(
                id: $role->getId(),
                name: $role->getName(),
                description: $role->getDescription(),
                status: $role->getStatus(),
                createdAt: $role->getCreatedAt(),
                updatedAt: $role->getUpdatedAt(),
            );
        }, $roles);

        return [
            'roles' => $dto,
            'stats' => [
                'total' => $total,
                'activos' => $activos,
                'inactivos' => $inactivos,
            ]
        ];
    }
}
