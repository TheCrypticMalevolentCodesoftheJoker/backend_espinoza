<?php

namespace App\Modules\Role\Application\UseCases\Write;

use App\Modules\Role\Application\DTOs\Write\StoreRoleDTO;
use App\Modules\Role\Domain\Entities\RoleEntity;
use App\Modules\Role\Domain\Exceptions\RoleAlreadyExistsException;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Domain\ValueObjects\RoleName;

class CreateRoleUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Crear un nuevo rol
    //--------------------------------------------------------------------------
    public function execute(StoreRoleDTO $storeRoleDTO): void
    {
        $name = new RoleName($storeRoleDTO->name);

        if ($this->roleInterface->findByName($name->value())) {
            throw new RoleAlreadyExistsException();
        }

        $entity = RoleEntity::create(
            name: $name,
        );

        $this->roleInterface->save($entity);
    }
}
