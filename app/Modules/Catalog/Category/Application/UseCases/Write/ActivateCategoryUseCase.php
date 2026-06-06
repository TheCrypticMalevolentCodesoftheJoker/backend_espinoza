<?php

//--------------------------------------------------------------------------
// ActivateCategoryUseCase: Modificación y habilitación de estado de una categoría
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Application\UseCases\Write;

use App\Modules\Catalog\Category\Domain\Exceptions\CategoryNotFoundException;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class ActivateCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Procesamiento: Modificación del estado del dominio y persistencia
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->categoryInterface->findById($id);

        if (!$entity) {
            throw new CategoryNotFoundException();
        }

        $entity->activate();

        $this->categoryInterface->update($entity);
    }
}
