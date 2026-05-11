<?php

namespace App\Modules\Catalog\Category\Domain\Interfaces;

use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;

interface CategoryInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function findAll(): array;

    public function findById(int $id): ?CategoryEntity;

    public function findByName(string $name): ?CategoryEntity;

    //----------------------------------------------------------------------
    // KPIs / AGREGACIONES
    //----------------------------------------------------------------------
    public function countAll(): int;

    public function countActive(): int;

    public function countInactive(): int;

    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function save(CategoryEntity $category): void;

    public function update(CategoryEntity $category): void;

    public function delete(int $id): void;
}
