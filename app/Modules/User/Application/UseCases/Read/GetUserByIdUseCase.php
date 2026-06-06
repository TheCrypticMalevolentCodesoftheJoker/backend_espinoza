<?php
//--------------------------------------------------------------------------
// GetUserByIdUseCase: Obtención de un usuario con resolución de rol vía RoleAccessGateway.
//--------------------------------------------------------------------------

namespace App\Modules\User\Application\UseCases\Read;

use App\Modules\User\Application\DTOs\Read\UserDTO;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\Exceptions\UserNotFoundException;
use App\Modules\User\Domain\Interfaces\RoleAccessGateway;

class GetUserByIdUseCase
{
    public function __construct(
        private UserInterface $userInterface,
        private RoleAccessGateway $roleAccessGateway
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Obtener un usuario por ID
    //--------------------------------------------------------------------------
    public function execute(int $id): UserDTO
    {
        $user = $this->userInterface->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $role = $this->roleAccessGateway->findById($user->getRoleId());

        return new UserDTO(
            id: $user->getId(),
            roleId: $user->getRoleId(),
            roleName: $role['name'],
            name: $user->getName(),
            email: $user->getEmail(),
            status: $user->getStatus(),
            createdAt: $user->getCreatedAt()?->format('Y-m-d H:i:s'),
            updatedAt: $user->getUpdatedAt()?->format('Y-m-d H:i:s'),
        );
    }
}
