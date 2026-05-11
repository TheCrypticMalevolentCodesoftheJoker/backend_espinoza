<?php

namespace App\Modules\Role\Application\UseCases;

use App\Modules\Role\Application\DTOs\RoleDTO;
use App\Modules\Role\Application\Mappers\RoleMapper;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Domain\Exceptions\RoleNotFoundException;
use App\Modules\Role\Domain\ValueObjects\RoleId;


class GetRoleByIdUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    public function execute(int $id): RoleDTO
    {
        $role = $this->roleInterface->findById($id);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return RoleMapper::toDTO($role);
    }
}

