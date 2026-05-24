<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Write;

use App\Modules\Catalog\Product\Domain\Exceptions\Product\ProductNotFoundException;
use App\Modules\Catalog\Product\Domain\Interfaces\Product\ProductInterface;

class DeactivateProductUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Desactivar un producto por su ID
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->productInterface->findById($id);

        if (!$entity) {
            throw new ProductNotFoundException();
        }

        $entity->deactivate();

        $this->productInterface->update($entity);
    }
}
