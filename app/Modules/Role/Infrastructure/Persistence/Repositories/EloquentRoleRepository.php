<?php

namespace App\Modules\Role\Infrastructure\Persistence\Repositories;

use App\Modules\Role\Domain\Entities\RoleEntity;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Domain\ValueObjects\RoleName;
use App\Modules\Role\Infrastructure\Persistence\Models\TblRol;

class EloquentRoleRepository implements RoleInterface
{
    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener todos los roles
    //--------------------------------------------------------------------------
    public function findAll(): array
    {
        return TblRol::all()
            ->map(fn($model) => RoleEntity::reconstitute(
                id: $model->id,
                name: new RoleName($model->name),
                status: $model->status,
                createdAt: $model->created_at?->toDateTime(),
                updatedAt: $model->updated_at?->toDateTime(),
            ))
            ->toArray();
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener roles activos
    //--------------------------------------------------------------------------
    public function findActive(): array
    {
        return TblRol::where('status', true)
            ->get()
            ->map(fn($model) => RoleEntity::reconstitute(
                id: $model->id,
                name: new RoleName($model->name),
                status: $model->status,
                createdAt: $model->created_at?->toDateTime(),
                updatedAt: $model->updated_at?->toDateTime(),
            ))
            ->toArray();
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener rol por ID
    //--------------------------------------------------------------------------
    public function findById(int $id): ?RoleEntity
    {
        $model = TblRol::find($id);

        return $model ? RoleEntity::reconstitute(
            id: $model->id,
            name: new RoleName($model->name),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener rol por nombre
    //--------------------------------------------------------------------------
    public function findByName(string $name): ?RoleEntity
    {
        $model = TblRol::where('name', $name)->first();

        return $model ? RoleEntity::reconstitute(
            id: $model->id,
            name: new RoleName($model->name),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Guardar un nuevo rol
    //--------------------------------------------------------------------------
    public function save(RoleEntity $roleEntity): void
    {
        TblRol::create([
            'name'        => $roleEntity->getName(),
            'status'      => $roleEntity->getStatus(),
        ]);
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Actualizar rol existente
    //--------------------------------------------------------------------------
    public function update(RoleEntity $role): void
    {
        $model = TblRol::findOrFail($role->getId());
        $model->update([
            'name'        => $role->getName(),
            'status'      => $role->getStatus(),
        ]);
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Eliminar rol por ID
    //--------------------------------------------------------------------------
    public function delete(int $id): void
    {
        TblRol::destroy($id);
    }
}
