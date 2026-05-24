<?php

namespace App\Modules\Role\Application\UseCases\Write;

use App\Modules\Role\Domain\Exceptions\RoleNotFoundException;
use App\Modules\Role\Domain\Interfaces\RoleInterface;

class ActivateRoleUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Activar un rol por ID
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->roleInterface->findById($id);

        if (!$entity) {
            throw new RoleNotFoundException();
        }

        $entity->activate();

        $this->roleInterface->update($entity);
    }
}
