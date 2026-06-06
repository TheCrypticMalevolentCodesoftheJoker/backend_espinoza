<?php

//--------------------------------------------------------------------------
// CategoryInterface: Contrato del repositorio para categorías
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Domain\Interfaces;

use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;

interface CategoryInterface
{
    public function findAll(): array;

    public function findActive(): array;

    public function findById(int $id): ?CategoryEntity;

    public function findByName(string $name): ?CategoryEntity;

    public function save(CategoryEntity $category): void;

    public function update(CategoryEntity $category): void;

    public function delete(int $id): void;
}
