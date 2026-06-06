<?php
//--------------------------------------------------------------------------
// RoleAccessGateway: Puerto anti-corrupción para consulta de roles desde el módulo externo.
//--------------------------------------------------------------------------

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
