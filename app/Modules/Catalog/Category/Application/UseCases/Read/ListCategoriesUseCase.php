<?php

namespace App\Modules\Catalog\Category\Application\UseCases\Read;

use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class ListCategoriesUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Listar todas las categorías
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $categories = $this->categoryInterface->findAll();

        return CategoryMapper::toDTOArray($categories);
    }
}
