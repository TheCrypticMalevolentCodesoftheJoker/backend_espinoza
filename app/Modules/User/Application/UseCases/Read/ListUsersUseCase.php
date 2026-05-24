<?php

namespace App\Modules\User\Application\UseCases\Read;

use App\Modules\User\Application\DTOs\Read\UserDTO;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\Interfaces\RoleAccessGateway;

class ListUsersUseCase
{
    public function __construct(
        private UserInterface $userInterface,
        private RoleAccessGateway $roleAccessGateway
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Listar todos los usuarios
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $users = $this->userInterface->findAll();

        $roleIds = array_unique(
            array_map(fn($u) => $u->getRoleId(), $users)
        );

        $roles = collect($this->roleAccessGateway->findByIds($roleIds))
            ->keyBy('id');

        return array_map(function ($user) use ($roles) {

            $roleId = $user->getRoleId();

            return new UserDTO(
                id: $user->getId(),
                roleId: $roleId,
                roleName: $roles->get($roleId)['name'],
                name: $user->getName(),
                email: $user->getEmail(),
                status: $user->getStatus(),
                createdAt: $user->getCreatedAt()?->format('Y-m-d H:i:s'),
                updatedAt: $user->getUpdatedAt()?->format('Y-m-d H:i:s'),
            );
        }, $users);
    }
}
