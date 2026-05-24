<?php

namespace App\Modules\Role\Domain\Interfaces;

use App\Modules\Role\Domain\Entities\RoleEntity;

interface RoleInterface
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Métodos de lectura de roles
    //--------------------------------------------------------------------------
    public function findAll(): array;

    public function findActive(): array;

    public function findById(int $id): ?RoleEntity;

    public function findByName(string $name): ?RoleEntity;

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Métodos de escritura y eliminación de roles
    //--------------------------------------------------------------------------
    public function save(RoleEntity $role): void;

    public function update(RoleEntity $role): void;

    public function delete(int $id): void;
}
