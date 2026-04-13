<?php

namespace App\Modules\Administration\Infrastructure\Persistence\Eloquent\Repositories;

use App\Models\TblCategory;
use App\Modules\Administration\Domain\Entities\CategoryEntity;
use App\Modules\Administration\Domain\Interfaces\CategoryInterface;
use App\Modules\Administration\Domain\ValueObjects\CategoryName;

class EloquentCategoryRepository implements CategoryInterface
{
    public function findAll(): array
    {
        return TblCategory::all()->map(function ($tblCategory) {
            return CategoryEntity::reconstitute(
                id: $tblCategory->id,
                name: new CategoryName($tblCategory->name),
                status: $tblCategory->status,
            );
        })->all();
    }
    public function save(CategoryEntity $categoryEntity): CategoryEntity
    {
        $model = TblCategory::create([
            'name' => $categoryEntity->getName(),
            'status' => $categoryEntity->getStatus(),
        ]);
        return CategoryEntity::reconstitute(
            id: $model->id,
            name: new CategoryName($model->name),
            status: $model->status,
        );
        
    }
}
