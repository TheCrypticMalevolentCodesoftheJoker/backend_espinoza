<?php

//--------------------------------------------------------------------------
// ListActiveCategoriesUseCase: Consulta y recuperación de categorías activas
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Application\UseCases\Read;

use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class ListActiveCategoriesUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Consulta: Recuperación de categorías filtradas por estado activo
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $categories = $this->categoryInterface->findActive();

        return CategoryMapper::toDTOArray($categories);
    }
}
