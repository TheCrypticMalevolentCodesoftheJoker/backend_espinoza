<?php

namespace App\Modules\Catalog\Product\Application\UseCases;

use App\Modules\Catalog\Product\Application\DTOs\ProductDTO;
use App\Modules\Catalog\Product\Application\Mappers\ProductMapper;
use App\Modules\Catalog\Product\Domain\Exceptions\ProductNotFoundException;
use App\Modules\Catalog\Product\Domain\Interfaces\BrandAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\CategoryAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\ProductInterface;

class GetProductByIdUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
        private CategoryAccessGateway $categoryAccessGateway,
        private BrandAccessGateway $brandAccessGateway,
    ) {}

    public function execute(int $id): ProductDTO
    {
        //--------------------------------------------------------------------------
        // USECASE -> Obtener producto por ID
        //--------------------------------------------------------------------------

        $entity = $this->productInterface->findById($id);

        if (!$entity) {
            throw new ProductNotFoundException();
        }

        //--------------------------------------------------------------------------
        // CARGAR RELACIONES Y MAPEAR
        //--------------------------------------------------------------------------
        $categories = $this->categoryAccessGateway->findByIds([$entity->getCategoryId()]);
        $brands     = $this->brandAccessGateway->findByIds([$entity->getBrandId()]);

        $categoryName = $categories[$entity->getCategoryId()]['name'] ?? 'Sin categoría';
        $brandName    = $brands[$entity->getBrandId()]['name'] ?? 'Sin marca';

        return ProductMapper::toDTO($entity, $categoryName, $brandName);
    }
}

