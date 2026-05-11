<?php

namespace App\Modules\User\Application\UseCases;

use App\Modules\User\Application\Mappers\UserRoleMapper;
use App\Modules\User\Domain\Interfaces\RoleAccessGateway;

class GetActiveRolesUseCase
{
    public function __construct(
        private RoleAccessGateway $roleAccessGateway
    ) {}

    public function execute(): array
    {
        $roles = $this->roleAccessGateway->findActiveRoles();
        return UserRoleMapper::toDTOArray($roles);
    }
}
