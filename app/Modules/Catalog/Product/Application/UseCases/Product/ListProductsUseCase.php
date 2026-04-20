<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Product;

use App\Modules\Catalog\Product\Application\Queries\ProductReadRepository;

class ListProductsUseCase
{
    public function __construct(
        private ProductReadRepository $productReadRepository
    ) {}

    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    public function Execute(): array
    {
        return $this->productReadRepository->findAll();
    }
}
