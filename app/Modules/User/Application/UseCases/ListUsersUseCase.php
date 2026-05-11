<?php

namespace App\Modules\User\Application\UseCases;

use App\Modules\User\Application\DTOs\UserDTO;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\Interfaces\RoleAccessGateway;

class ListUsersUseCase
{
    public function __construct(
        private UserInterface $userInterface,
        private RoleAccessGateway $roleAccessGateway
    ) {}

    public function execute(): array
    {
        $users = $this->userInterface->findAll();

        $total = $this->userInterface->countAll();
        $activos = $this->userInterface->countActive();
        $inactivos = $this->userInterface->countInactive();

        $roleIds = array_unique(
            array_map(fn($u) => $u->getRoleId(), $users)
        );

        $roles = collect(
            $this->roleAccessGateway->findByIds($roleIds)
        )->keyBy('id');

        $dto = array_map(function ($user) use ($roles) {

            $roleId = $user->getRoleId();

            return new UserDTO(
                id: $user->getId(),
                roleId: $roleId,
                roleName: $roles[$roleId]['name'] ?? null,
                name: $user->getName(),
                email: $user->getEmail(),
                password: $user->getPassword(),
                status: $user->getStatus(),
                createdAt: $user->getCreatedAt(),
                updatedAt: $user->getUpdatedAt(),
            );
        }, $users);

        return [
            'users' => $dto,
            'stats' => [
                'total' => $total,
                'activos' => $activos,
                'inactivos' => $inactivos,
            ]
        ];
    }
}
