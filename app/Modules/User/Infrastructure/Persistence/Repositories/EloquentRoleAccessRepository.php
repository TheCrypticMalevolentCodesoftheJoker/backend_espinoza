<?php
//--------------------------------------------------------------------------
// EloquentRoleAccessRepository: Implementación del gateway anti-corrupción para roles.
// Accede a TblRol del módulo externo Role para consultas de verificación y lectura.
//--------------------------------------------------------------------------

namespace App\Modules\User\Infrastructure\Persistence\Repositories;

use App\Modules\User\Domain\Interfaces\RoleAccessGateway;
use App\Modules\Role\Infrastructure\Persistence\Models\TblRol;

class EloquentRoleAccessRepository implements RoleAccessGateway
{
    //--------------------------------------------------------------------------
    // CONSULTA -> Verificar si un rol existe por ID
    //--------------------------------------------------------------------------
    public function exists(int $roleId): bool
    {
        return TblRol::where('id', $roleId)->exists();
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener datos básicos de un rol por ID
    //--------------------------------------------------------------------------
    public function findById(int $roleId): array
    {
        $role = TblRol::find($roleId, ['id', 'name']);

        return [
            'id'   => $role->id,
            'name' => $role->name,
        ];
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener datos básicos de múltiples roles por IDs
    //--------------------------------------------------------------------------
    public function findByIds(array $roleIds): array
    {
        return TblRol::whereIn('id', $roleIds)
            ->get(['id', 'name'])
            ->keyBy('id')
            ->map(fn($row) => [
                'id'   => $row->id,
                'name' => $row->name,
            ])
            ->toArray();
    }
}
