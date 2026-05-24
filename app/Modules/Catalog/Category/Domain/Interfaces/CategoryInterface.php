<?php

namespace App\Modules\Catalog\Category\Domain\Interfaces;

use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;

interface CategoryInterface
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Métodos de lectura de categorías
    //--------------------------------------------------------------------------
    public function findAll(): array;

    public function findActive(): array;

    public function findById(int $id): ?CategoryEntity;

    public function findByName(string $name): ?CategoryEntity;

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Métodos de escritura y eliminación de categorías
    //--------------------------------------------------------------------------
    public function save(CategoryEntity $category): void;

    public function update(CategoryEntity $category): void;

    public function delete(int $id): void;
}
