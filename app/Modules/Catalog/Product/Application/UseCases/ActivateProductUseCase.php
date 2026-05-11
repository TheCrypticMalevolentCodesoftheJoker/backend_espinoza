<?php

namespace App\Modules\Catalog\Product\Application\UseCases;

use App\Modules\Catalog\Product\Domain\Exceptions\ProductNotFoundException;
use App\Modules\Catalog\Product\Domain\Interfaces\ProductInterface;

class ActivateProductUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
    ) {}

    public function execute(int $id): void
    {
        //--------------------------------------------------------------------------
        // USECASE -> Activar producto
        //--------------------------------------------------------------------------

        $entity = $this->productInterface->findById($id);

        if (!$entity) {
            throw new ProductNotFoundException();
        }

        $entity->activate();

        $this->productInterface->update($entity);
    }
}

