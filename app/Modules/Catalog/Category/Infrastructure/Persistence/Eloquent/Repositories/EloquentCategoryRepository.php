<?php

namespace App\Modules\Catalog\Category\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryName;
use App\Modules\Catalog\Category\Infrastructure\Persistence\Eloquent\Models\TblCategory;

class EloquentCategoryRepository implements CategoryInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function findAll(): array
    {
        return TblCategory::all()
            ->map(fn($model) => CategoryEntity::reconstitute(
                id: $model->id,
                name: new CategoryName($model->name),
                status: $model->status,
                createdAt: $model->created_at?->toDateTime(),
                updatedAt: $model->updated_at?->toDateTime(),
            ))
            ->toArray();
    }

    public function findById(int $id): ?CategoryEntity
    {
        $model = TblCategory::find($id);

        return $model ? CategoryEntity::reconstitute(
            id: $model->id,
            name: new CategoryName($model->name),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }

    public function findByName(string $name): ?CategoryEntity
    {
        $model = TblCategory::where('name', $name)->first();

        return $model ? CategoryEntity::reconstitute(
            id: $model->id,
            name: new CategoryName($model->name),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }

    //--------------------------------------------------------------------------
    // KPIs / AGREGACIONES
    //--------------------------------------------------------------------------
    public function countAll(): int
    {
        return TblCategory::count();
    }

    public function countActive(): int
    {
        return TblCategory::where('status', 1)->count();
    }

    public function countInactive(): int
    {
        return TblCategory::where('status', 0)->count();
    }
    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function save(CategoryEntity $categoryEntity): void
    {
        TblCategory::create([
            'name'   => $categoryEntity->getName(),
            'status' => $categoryEntity->getStatus(),
        ]);
    }

    public function update(CategoryEntity $category): void
    {
        $model = TblCategory::findOrFail($category->getId());
        $model->update([
            'name'   => $category->getName(),
            'status' => $category->getStatus(),
        ]);
    }

    public function delete(int $id): void
    {
        TblCategory::destroy($id);
    }
}
