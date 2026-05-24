<?php

namespace App\Modules\Catalog\Category\Application\UseCases\Read;

use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class ListActiveCategoriesUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Listar categorías activas
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $categories = $this->categoryInterface->findActive();

        return CategoryMapper::toDTOArray($categories);
    }
}
