<?php

namespace App\Modules\Catalog\Category\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Catalog\Category\Application\DTOs\StoreCategoryDTO;
use App\Modules\Catalog\Category\Application\DTOs\UpdateCategoryDTO;
use App\Modules\Catalog\Category\Application\UseCases\ActivateCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\CreateCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\DeactivateCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\DeleteCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\GetCategoryByIdUseCase;
use App\Modules\Catalog\Category\Application\UseCases\ListCategoriesUseCase;
use App\Modules\Catalog\Category\Application\UseCases\UpdateCategoryUseCase;

class CategoryService
{
    public function __construct(
        private ListCategoriesUseCase $listCategoriesUseCase,
        private CreateCategoryUseCase $createCategoryUseCase,
        private GetCategoryByIdUseCase $getCategoryByIdUseCase,
        private UpdateCategoryUseCase $updateCategoryUseCase,
        private ActivateCategoryUseCase $activateCategoryUseCase,
        private DeactivateCategoryUseCase $deactivateCategoryUseCase,
        private DeleteCategoryUseCase $deleteCategoryUseCase,
    ) {}
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    //----------------------------------------------------------------------------------
    // LISTAR CATEGORÍAS
    //----------------------------------------------------------------------------------
    public function listCategories(): array
    {
        return $this->listCategoriesUseCase->Execute();
    }

    //----------------------------------------------------------------------------------
    // OBTENER CATEGORÍA POR ID
    //----------------------------------------------------------------------------------
    public function getCategory(string $id)
    {
        return $this->getCategoryByIdUseCase->Execute($id);
    }

    //----------------------------------------------------------------------------------
    // CREAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function createCategory(StoreCategoryDTO $storeCategoryDTO)
    {
        return DB::transaction(
            fn() =>
            $this->createCategoryUseCase->Execute($storeCategoryDTO)
        );
    }

    //----------------------------------------------------------------------------------
    // ACTUALIZAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function updateCategory(string $id, UpdateCategoryDTO $updateCategoryDTO)
    {
        return DB::transaction(
            fn() =>
            $this->updateCategoryUseCase->Execute($id, $updateCategoryDTO)
        );
    }

    //----------------------------------------------------------------------------------
    // ACTIVAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function activateCategory(string $id)
    {
        return DB::transaction(
            fn() => $this->activateCategoryUseCase->execute($id)
        );
    }

    //----------------------------------------------------------------------------------
    // DESACTIVAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function deactivateCategory(string $id)
    {
        return DB::transaction(
            fn() => $this->deactivateCategoryUseCase->execute($id)
        );
    }

    //----------------------------------------------------------------------------------
    // ELIMINAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function deleteCategory(string $id)
    {
        return DB::transaction(function () use ($id) {
            return $this->deleteCategoryUseCase->execute($id);
        });
    }
}
