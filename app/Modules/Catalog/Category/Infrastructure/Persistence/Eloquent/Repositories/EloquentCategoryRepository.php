<?php

namespace App\Modules\Catalog\Category\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Category\Infrastructure\Persistence\Eloquent\Models\TblCategory;
use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryName;

class EloquentCategoryRepository implements CategoryInterface
{
    /*----------------------------------------------------------------------------------
    LISTAR CATEGORÍAS
    ----------------------------------------------------------------------------------*/
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

    /*----------------------------------------------------------------------------------
    GUARDAR CATEGORÍA
    ----------------------------------------------------------------------------------*/
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

    /*----------------------------------------------------------------------------------
    BUSCAR CATEGORÍA POR ID
    ----------------------------------------------------------------------------------*/
    public function findById(int $id): ?CategoryEntity
    {
        $model = TblCategory::find($id);

        if (!$model) {
            return null;
        }

        return CategoryEntity::reconstitute(
            id: $model->id,
            name: new CategoryName($model->name),
            status: $model->status,
        );
    }

    /*----------------------------------------------------------------------------------
    BUSCAR CATEGORÍA POR NOMBRE
    ----------------------------------------------------------------------------------*/
    public function findByName(string $name): ?CategoryEntity
    {
        $model = TblCategory::where('name', $name)->first();

        if (!$model) {
            return null;
        }

        return CategoryEntity::reconstitute(
            id: $model->id,
            name: new CategoryName($model->name),
            status: $model->status,
        );
    }

    /*----------------------------------------------------------------------------------
    ACTUALIZAR CATEGORÍA
    ----------------------------------------------------------------------------------*/
    public function update(CategoryEntity $category): CategoryEntity
    {
        $model = TblCategory::findOrFail($category->getId());

        $model->update([
            'name' => $category->getName(),
            'status' => $category->getStatus(),
        ]);

        return CategoryEntity::reconstitute(
            id: $model->id,
            name: new CategoryName($model->name),
            status: $model->status,
        );
    }
    /*----------------------------------------------------------------------------------
    Eliminar categoría
    ----------------------------------------------------------------------------------*/
    public function delete(int $id): void
    {
        TblCategory::destroy($id);
    }
}
