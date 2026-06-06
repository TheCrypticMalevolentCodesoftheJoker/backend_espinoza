<?php
//--------------------------------------------------------------------------
// UpdateUserUseCase: Actualización de usuario con validación de rol, unicidad de email
// y cambio opcional de contraseña.
//--------------------------------------------------------------------------

namespace App\Modules\User\Application\UseCases\Write;

use App\Modules\User\Application\DTOs\Write\UpdateUserDTO;
use App\Modules\User\Domain\Exceptions\InvalidRoleException;
use App\Modules\User\Domain\Exceptions\UserAlreadyExistsException;
use App\Modules\User\Domain\Exceptions\UserNotFoundException;
use App\Modules\User\Domain\Interfaces\RoleAccessGateway;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\ValueObjects\UserName;
use App\Modules\User\Domain\ValueObjects\UserEmail;
use App\Modules\User\Domain\ValueObjects\UserPassword;
use App\Modules\User\Domain\ValueObjects\UserRoleId;
use Illuminate\Support\Facades\Hash;

class UpdateUserUseCase
{
    public function __construct(
        private UserInterface $userInterface,
        private RoleAccessGateway $roleAccessGateway
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Actualizar un usuario existente
    //--------------------------------------------------------------------------
    public function execute(int $id, UpdateUserDTO $updateUserDTO): void
    {
        $entity = $this->userInterface->findById($id);

        if (!$entity) {
            throw new UserNotFoundException();
        }

        $newRoleId = new UserRoleId($updateUserDTO->roleId);
        $newName = new UserName($updateUserDTO->name);
        $newEmail = new UserEmail($updateUserDTO->email);

        // VALIDACIÓN -> Verificar que el rol existe
        if (!$this->roleAccessGateway->exists($newRoleId->value())) {
            throw new InvalidRoleException;
        }

        // VALIDACIÓN -> Verificar que el correo electrónico no esté duplicado
        $existing = $this->userInterface->findByEmail($newEmail->value());

        if ($existing && $existing->getId() !== $entity->getId()) {
            throw new UserAlreadyExistsException();
        }

        // ENTIDAD -> Modificar los atributos de la entidad
        $entity->changeRole($newRoleId);
        $entity->changeName($newName);
        $entity->changeEmail($newEmail);

        // PREPARACIÓN -> Actualizar contraseña si se proporciona una nueva
        if (!empty($updateUserDTO->password)) {
            $plainPassword = new UserPassword($updateUserDTO->password);

            $hashedPassword = new UserPassword(
                Hash::make($plainPassword->value())
            );

            $entity->changePassword($hashedPassword);
        }

        // PERSISTENCIA -> Actualizar en base de datos
        $this->userInterface->update($entity);
    }
}
