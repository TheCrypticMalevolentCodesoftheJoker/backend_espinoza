<?php

namespace App\Modules\Catalog\Brand\Domain\Interfaces;

use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;

interface BrandInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function findAll(): array;

    public function findById(int $id): ?BrandEntity;

    public function findByName(string $name): ?BrandEntity;

    //----------------------------------------------------------------------
    // KPIs / AGREGACIONES
    //----------------------------------------------------------------------
    public function countAll(): int;

    public function countActive(): int;

    public function countInactive(): int;

    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function save(BrandEntity $brand): void;

    public function update(BrandEntity $brand): void;

    public function delete(int $id): void;
}
