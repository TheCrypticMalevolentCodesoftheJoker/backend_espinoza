<?php

namespace App\Modules\User\Application\UseCases;

use App\Modules\User\Application\DTOs\UserDTO;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\Exceptions\UserNotFoundException;
use App\Modules\User\Domain\Interfaces\RoleAccessGateway;

class GetUserByIdUseCase
{
    public function __construct(
        private UserInterface $userInterface,
        private RoleAccessGateway $roleAccessGateway
    ) {}

    public function execute(int $id): UserDTO
    {
        $user = $this->userInterface->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $roleId = $user->getRoleId();

        $role = $this->roleAccessGateway
            ->findByIds([$roleId])[$roleId];

        return new UserDTO(
            id: $user->getId(),
            roleId: $roleId,
            roleName: $role['name'],
            name: $user->getName(),
            email: $user->getEmail(),
            password: $user->getPassword(),
            status: $user->getStatus(),
            createdAt: $user->getCreatedAt(),
            updatedAt: $user->getUpdatedAt(),
        );
    }
}
