<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Application\DTOs\StoreRoleDTO;
use App\Modules\Role\Domain\Entities\RoleEntity;
use App\Modules\Role\Domain\Exceptions\RoleAlreadyExistsException;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Domain\ValueObjects\RoleName;
use App\Modules\Role\Domain\ValueObjects\RoleDescription;

class CreateRoleUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    public function execute(StoreRoleDTO $storeRoleDTO): void
    {
        $name = new RoleName($storeRoleDTO->name);
        $description = new RoleDescription($storeRoleDTO->description);

        if ($this->roleInterface->findByName($name->value())) {
            throw new RoleAlreadyExistsException();
        }

        $entity = RoleEntity::create(
            name: $name,
            description: $description
        );

        $this->roleInterface->save($entity);
    }
}

