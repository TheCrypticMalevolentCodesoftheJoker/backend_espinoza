<?php

namespace App\Modules\User\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\User\Domain\Interfaces\RoleAccessGateway;
use App\Modules\Role\Infrastructure\Persistence\Eloquent\Models\TblRol;

class EloquentRoleAccessRepository implements RoleAccessGateway
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------

    public function exists(int $roleId): bool
    {
        return TblRol::where('id', $roleId)->exists();
    }

    public function findByIds(array $ids): array
    {
        return TblRol::whereIn('id', $ids)
            ->get(['id', 'name'])
            ->keyBy('id')
            ->map(fn($r) => [
                'id' => $r->id,
                'name' => $r->name,
            ])
            ->toArray();
    }

    public function findActiveRoles(): array
    {
        return TblRol::where('status', true)
            ->get(['id', 'name'])
            ->keyBy('id')
            ->map(fn($r) => [
                'id' => $r->id,
                'name' => $r->name,
            ])
            ->toArray();
    }
}
