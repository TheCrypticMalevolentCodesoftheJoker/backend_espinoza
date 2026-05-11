<?php

namespace App\Modules\Role\Domain\Interfaces;

use App\Modules\Role\Domain\Entities\RoleEntity;

interface RoleInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function findAll(): array;

    public function findById(int $id): ?RoleEntity;

    public function findByName(string $name): ?RoleEntity;

    //----------------------------------------------------------------------
    // KPIs / AGREGACIONES
    //----------------------------------------------------------------------
    public function countAll(): int;

    public function countActive(): int;

    public function countInactive(): int;

    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function save(RoleEntity $role): void;

    public function update(RoleEntity $role): void;

    public function delete(int $id): void;
}
