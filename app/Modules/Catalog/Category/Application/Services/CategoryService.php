<?php

namespace App\Modules\Catalog\Category\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Catalog\Category\Application\DTOs\StoreCategoryDTO;
use App\Modules\Catalog\Category\Application\DTOs\UpdateCategoryDTO;
use App\Modules\Catalog\Category\Application\UseCases\ActivateCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\CreateCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\DeactivateCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\DeleteCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\UpdateCategoryUseCase;

class CategoryService
{
    public function __construct(
        private CreateCategoryUseCase $createCategoryUseCase,
        private UpdateCategoryUseCase $updateCategoryUseCase,
        private ActivateCategoryUseCase $activateCategoryUseCase,
        private DeactivateCategoryUseCase $deactivateCategoryUseCase,
        private DeleteCategoryUseCase $deleteCategoryUseCase,
    ) {}
    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function createCategory(StoreCategoryDTO $storeCategoryDTO): void
    {
        DB::transaction(fn() => $this->createCategoryUseCase->execute($storeCategoryDTO));
    }

    public function updateCategory(int $id, UpdateCategoryDTO $updateCategoryDTO): void
    {
        DB::transaction(fn() => $this->updateCategoryUseCase->execute($id, $updateCategoryDTO));
    }

    public function activateCategory(int $id): void
    {
        DB::transaction(fn() => $this->activateCategoryUseCase->execute($id));
    }

    public function deactivateCategory(int $id): void
    {
        DB::transaction(fn() => $this->deactivateCategoryUseCase->execute($id));
    }

    public function deleteCategory(int $id): void
    {
        DB::transaction(fn() => $this->deleteCategoryUseCase->execute($id));
    }
}
