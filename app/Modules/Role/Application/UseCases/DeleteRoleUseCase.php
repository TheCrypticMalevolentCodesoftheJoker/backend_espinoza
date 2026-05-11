<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Domain\Exceptions\RoleNotFoundException;
use App\Modules\Role\Domain\Interfaces\RoleInterface;

class DeleteRoleUseCase
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

        $this->roleInterface->delete($entity->getId());
    }
}

