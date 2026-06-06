<?php

//--------------------------------------------------------------------------
// ListCategoriesUseCase: Consulta y recuperación del catálogo completo de categorías
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Application\UseCases\Read;

use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class ListCategoriesUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Consulta: Recuperación total de categorías registradas en el sistema
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $categories = $this->categoryInterface->findAll();

        return CategoryMapper::toDTOArray($categories);
    }
}
