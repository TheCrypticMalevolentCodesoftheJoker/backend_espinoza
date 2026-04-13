<?php

namespace App\Modules\Administration\Domain\Interfaces;

use App\Modules\Administration\Domain\Entities\CategoryEntity;

interface CategoryInterface
{
    public function findAll(): array;
    public function save(CategoryEntity $category): CategoryEntity;
}
