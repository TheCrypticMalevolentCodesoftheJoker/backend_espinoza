<?php

namespace App\Modules\Role\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Role\Domain\Entities\RoleEntity;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Domain\ValueObjects\RoleName;
use App\Modules\Role\Domain\ValueObjects\RoleDescription;
use App\Modules\Role\Infrastructure\Persistence\Eloquent\Models\TblRol;

class EloquentRoleRepository implements RoleInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function findAll(): array
    {
        return TblRol::all()
            ->map(fn($model) => RoleEntity::reconstitute(
                id: $model->id,
                name: new RoleName($model->name),
                description: new RoleDescription($model->description),
                status: $model->status,
                createdAt: $model->created_at?->toDateTime(),
                updatedAt: $model->updated_at?->toDateTime(),
            ))
            ->toArray();
    }

    public function findById(int $id): ?RoleEntity
    {
        $model = TblRol::find($id);

        return $model ? RoleEntity::reconstitute(
            id: $model->id,
            name: new RoleName($model->name),
            description: new RoleDescription($model->description),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }

    public function findByName(string $name): ?RoleEntity
    {
        $model = TblRol::where('name', $name)->first();

        return $model ? RoleEntity::reconstitute(
            id: $model->id,
            name: new RoleName($model->name),
            description: new RoleDescription($model->description),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }

    //----------------------------------------------------------------------
    // KPIs / AGREGACIONES
    //----------------------------------------------------------------------
    public function countAll(): int
    {
        return TblRol::count();
    }

    public function countActive(): int
    {
        return TblRol::where('status', 1)->count();
    }

    public function countInactive(): int
    {
        return TblRol::where('status', 0)->count();
    }

    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function save(RoleEntity $roleEntity): void
    {
        TblRol::create([
            'name'        => $roleEntity->getName(),
            'description' => $roleEntity->getDescription(),
            'status'      => $roleEntity->getStatus(),
        ]);
    }

    public function update(RoleEntity $role): void
    {
        $model = TblRol::findOrFail($role->getId());
        $model->update([
            'name'        => $role->getName(),
            'description' => $role->getDescription(),
            'status'      => $role->getStatus(),
        ]);
    }

    public function delete(int $id): void
    {
        TblRol::destroy($id);
    }
}
