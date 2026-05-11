<?php

namespace App\Modules\User\Application\UseCases;

use App\Modules\User\Application\DTOs\UpdateUserDTO;
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

    public function execute(int $id, UpdateUserDTO $updateUserDTO): void
    {
        $entity = $this->userInterface->findById($id);

        if (!$entity) {
            throw new UserNotFoundException();
        }

        $newRoleId = new UserRoleId($updateUserDTO->roleId);
        $newName = new UserName($updateUserDTO->name);
        $newEmail = new UserEmail($updateUserDTO->email);

        // --------------------------------------------------
        // VALIDAR ROL
        // --------------------------------------------------
        if (!$this->roleAccessGateway->exists($newRoleId->value())) {
            throw new InvalidRoleException;
        }

        // --------------------------------------------------
        // VALIDAR EMAIL DUPLICADO
        // --------------------------------------------------
        $existing = $this->userInterface->findByEmail($newEmail->value());

        if ($existing && $existing->getId() !== $entity->getId()) {
            throw new UserAlreadyExistsException();
        }

        // --------------------------------------------------
        // ACTUALIZAR DATOS
        // --------------------------------------------------
        $entity->changeRole($newRoleId);
        $entity->changeName($newName);
        $entity->changeEmail($newEmail);

        // --------------------------------------------------
        // PASSWORD (opcional)
        // --------------------------------------------------
        if (!empty($updateUserDTO->password)) {
            $plainPassword = new UserPassword($updateUserDTO->password);

            $hashedPassword = new UserPassword(
                Hash::make($plainPassword->value())
            );

            $entity->changePassword($hashedPassword);
        }

        $this->userInterface->update($entity);
    }
}
