<?php

//--------------------------------------------------------------------------
// DeactivateCategoryUseCase: Desactivación lógica de una categoría
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Application\UseCases\Write;

use App\Modules\Catalog\Category\Domain\Exceptions\CategoryNotFoundException;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class DeactivateCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Procesamiento: Modificación del estado de activación de la categoría
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->categoryInterface->findById($id);

        if (!$entity) {
            throw new CategoryNotFoundException();
        }

        $entity->deactivate();

        $this->categoryInterface->update($entity);
    }
}
