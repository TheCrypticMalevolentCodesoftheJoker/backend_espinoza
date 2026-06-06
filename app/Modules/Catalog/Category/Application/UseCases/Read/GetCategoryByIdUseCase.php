<?php

//--------------------------------------------------------------------------
// GetCategoryByIdUseCase: Consulta y obtención de una categoría específica por su ID
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Application\UseCases\Read;

use App\Modules\Catalog\Category\Application\DTOs\Read\CategoryDTO;
use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\Exceptions\CategoryNotFoundException;

class GetCategoryByIdUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Consulta: Búsqueda de la categoría por ID en persistencia
    //--------------------------------------------------------------------------
    public function execute(int $id): CategoryDTO
    {
        $category = $this->categoryInterface->findById($id);

        if (!$category) {
            throw new CategoryNotFoundException();
        }

        return CategoryMapper::toDTO($category);
    }
}
