<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Product;

use App\Modules\Catalog\Product\Application\DTOs\Product\ProductDetailDTO;
use App\Modules\Catalog\Product\Application\Queries\ProductReadRepository;

class GetProductByIdUseCase
{
    public function __construct(
        private ProductReadRepository $productReadRepository
    ) {}

    public function execute(string $id): ?ProductDetailDTO
    {
        return $this->productReadRepository->findById($id);
    }
}
