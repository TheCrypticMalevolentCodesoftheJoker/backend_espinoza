<?php
//--------------------------------------------------------------------------
// DeactivateRoleUseCase: Desactivación de un rol existente por su identificador.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Application\UseCases\Write;

use App\Modules\Role\Domain\Exceptions\RoleNotFoundException;
use App\Modules\Role\Domain\Interfaces\RoleInterface;

class DeactivateRoleUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Desactivar un rol por ID
    //--------------------------------------------------------------------------
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
