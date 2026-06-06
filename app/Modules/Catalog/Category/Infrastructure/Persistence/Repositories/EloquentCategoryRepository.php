<?php

//--------------------------------------------------------------------------
// EloquentCategoryRepository: Implementación Eloquent del repositorio de categorías
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Infrastructure\Persistence\Repositories;

use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryName;
use App\Modules\Catalog\Category\Infrastructure\Persistence\Models\TblCategory;

class EloquentCategoryRepository implements CategoryInterface
{
    //--------------------------------------------------------------------------
    // Consulta: Recuperación de entidades y colecciones desde la base de datos
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

    public function findActive(): array
    {
        return TblCategory::where('status', true)
            ->get()
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
    // Persistencia: Almacenamiento, actualización y remoción de registros
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
