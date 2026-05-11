<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Application\DTOs\UpdateRoleDTO;
use App\Modules\Role\Domain\Exceptions\RoleAlreadyExistsException;
use App\Modules\Role\Domain\Exceptions\RoleNotFoundException;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Domain\ValueObjects\RoleName;
use App\Modules\Role\Domain\ValueObjects\RoleDescription;

class UpdateRoleUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    public function execute(int $id, UpdateRoleDTO $updateRoleDTO): void
    {
        $entity = $this->roleInterface->findById($id);

        if (!$entity) {
            throw new RoleNotFoundException();
        }

        $newName = new RoleName($updateRoleDTO->name);
        $newDescription = new RoleDescription($updateRoleDTO->description);

        $existing = $this->roleInterface->findByName($newName->value());
        if ($existing && $existing->getId() !== $entity->getId()) {
            throw new RoleAlreadyExistsException();
        }

        $entity->changeName($newName);
        $entity->changeDescription($newDescription);

        $this->roleInterface->update($entity);
    }
}

