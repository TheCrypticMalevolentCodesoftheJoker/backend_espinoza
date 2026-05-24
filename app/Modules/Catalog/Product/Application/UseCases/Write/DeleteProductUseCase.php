<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Write;

use App\Modules\Catalog\Product\Domain\Exceptions\Product\ProductNotFoundException;
use App\Modules\Catalog\Product\Domain\Interfaces\Product\ProductInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\S3Gateway;

class DeleteProductUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
        private S3Gateway $s3Gateway,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Eliminar un producto por su ID
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->productInterface->findById($id);

        if (!$entity) {
            throw new ProductNotFoundException();
        }

        $this->s3Gateway->deleteAll($id);
        $this->productInterface->delete($id);
    }
}
