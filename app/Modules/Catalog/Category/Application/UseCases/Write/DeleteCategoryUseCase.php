<?php

//--------------------------------------------------------------------------
// DeleteCategoryUseCase: Eliminación física o remoción de una categoría
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Application\UseCases\Write;

use App\Modules\Catalog\Category\Domain\Exceptions\CategoryNotFoundException;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class DeleteCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Persistencia: Remoción de la entidad del almacenamiento persistente
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->categoryInterface->findById($id);

        if (!$entity) {
            throw new CategoryNotFoundException();
        }

        $this->categoryInterface->delete($entity->getId());
    }
}
