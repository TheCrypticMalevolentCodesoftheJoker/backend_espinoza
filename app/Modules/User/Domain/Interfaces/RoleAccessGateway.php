<?php

namespace App\Modules\User\Domain\Interfaces;

interface RoleAccessGateway
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function exists(int $roleId): bool;
    public function findByIds(array $ids): array;
    public function findActiveRoles(): array;
}
