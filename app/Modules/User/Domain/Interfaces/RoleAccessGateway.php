<?php

namespace App\Modules\User\Domain\Interfaces;

interface RoleAccessGateway
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Verificación y lectura de roles del sistema
    //--------------------------------------------------------------------------
    public function exists(int $roleId): bool;
    
    public function findById(int $roleId): array;

    public function findByIds(array $ids): array;
}
