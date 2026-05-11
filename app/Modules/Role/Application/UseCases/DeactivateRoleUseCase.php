<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Domain\Exceptions\RoleNotFoundException;
use App\Modules\Role\Domain\Interfaces\RoleInterface;

class DeactivateRoleUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    public function execute(int $id): void
    {
        $entity = $this->roleInterface->findById($id);

        if (!$entity) {
            throw new RoleNotFoundException();
        }

        $entity->deactivate();

        $this->roleInterface->update($entity);
    }
}

