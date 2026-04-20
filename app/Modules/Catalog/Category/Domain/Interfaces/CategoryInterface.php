<?php

namespace App\Modules\Catalog\Category\Domain\Interfaces;

use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;

interface CategoryInterface
{
    public function findAll(): array;

    public function save(CategoryEntity $category): CategoryEntity;

    public function findById(int $id): ?CategoryEntity;

    public function findByName(string $name): ?CategoryEntity;

    public function update(CategoryEntity $category): CategoryEntity;

    public function delete(int $id): void;
}
