<?php

namespace App\Modules\User\Application\UseCases;

use App\Modules\User\Application\DTOs\StoreUserDTO;
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

    public function execute(StoreUserDTO $storeUserDTO): void
    {
        $roleId = new UserRoleId($storeUserDTO->roleId);
        $name = new UserName($storeUserDTO->name);
        $email = new UserEmail($storeUserDTO->email);
        $password = new UserPassword($storeUserDTO->password);

        // --------------------------------------------------
        // VALIDAR ROL EXISTE
        // --------------------------------------------------
        if (!$this->roleAccessGateway->exists($roleId->value())) {
            throw new InvalidRoleException;
        }

        // --------------------------------------------------
        // VALIDAR EMAIL DUPLICADO
        // --------------------------------------------------
        if ($this->userInterface->findByEmail($email->value())) {
            throw new UserAlreadyExistsException();
        }

        // --------------------------------------------------
        // HASH PASSWORD
        // --------------------------------------------------
        $hashedPassword = new UserPassword(
            Hash::make($password->value())
        );

        // --------------------------------------------------
        // CREAR USUARIO
        // --------------------------------------------------
        $entity = UserEntity::create(
            roleId: $roleId,
            name: $name,
            email: $email,
            password: $hashedPassword
        );

        $this->userInterface->save($entity);
    }
}
