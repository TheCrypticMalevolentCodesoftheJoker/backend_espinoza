<?php

namespace App\Modules\User\Application\UseCases\Write;

use App\Modules\User\Application\DTOs\Write\StoreUserDTO;
use App\Modules\User\Domain\Entities\UserEntity;
use App\Modules\User\Domain\Exceptions\InvalidRoleException;
use App\Modules\User\Domain\Exceptions\UserAlreadyExistsException;
use App\Modules\User\Domain\Interfaces\RoleAccessGateway;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\ValueObjects\UserName;
use App\Modules\User\Domain\ValueObjects\UserEmail;
use App\Modules\User\Domain\ValueObjects\UserPassword;
use App\Modules\User\Domain\ValueObjects\UserRoleId;
use Illuminate\Support\Facades\Hash;

class CreateUserUseCase
{
    public function __construct(
        private UserInterface $userInterface,
        private RoleAccessGateway $roleAccessGateway
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Crear un nuevo usuario
    //--------------------------------------------------------------------------
    public function execute(StoreUserDTO $storeUserDTO): void
    {
        // VALIDACIÓN -> Verificar que el rol existe
        $roleId = new UserRoleId($storeUserDTO->roleId);

        if (!$this->roleAccessGateway->exists($roleId->value())) {
            throw new InvalidRoleException();
        }

        // VALIDACIÓN -> Verificar que el correo electrónico no esté duplicado
        $email = new UserEmail($storeUserDTO->email);

        if ($this->userInterface->findByEmail($email->value())) {
            throw new UserAlreadyExistsException();
        }

        // PREPARACIÓN -> Encriptar contraseña y construir value objects
        $name = new UserName($storeUserDTO->name);
        $password = new UserPassword(
            Hash::make($storeUserDTO->password)
        );

        // ENTIDAD -> Crear instancia del usuario
        $entity = UserEntity::create(
            roleId: $roleId,
            name: $name,
            email: $email,
            password: $password
        );

        // PERSISTENCIA -> Guardar el usuario en base de datos
        $this->userInterface->save($entity);
    }
}
