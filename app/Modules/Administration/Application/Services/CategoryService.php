<?php

namespace App\Modules\Administration\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Administration\Application\DTOs\CreateCategoryDTO;
use App\Modules\Administration\Application\UseCases\CreateCategoryUseCase;
use App\Modules\Administration\Application\UseCases\ListCategoriesUseCase;

class CategoryService
{
    public function __construct(
        private ListCategoriesUseCase $listCategoriesUseCase,
        private CreateCategoryUseCase $createCategoryUseCase
    ) {}
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    public function listCategories(): array
    {
        return $this->listCategoriesUseCase->Execute();
    }

    // Operación de persistencia atómica (ACID)
    public function createCategory(CreateCategoryDTO $createCategoryDTO)
    {
        return DB::transaction(function () use ($createCategoryDTO) {
            return $this->createCategoryUseCase->Execute($createCategoryDTO);
        });
    }
}
