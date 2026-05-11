<?php

namespace App\Modules\Catalog\Product\Application\UseCases;

use App\Modules\Catalog\Product\Domain\Interfaces\CategoryAccessGateway;

class GetActiveCategoriesUseCase
{
    public function __construct(
        private CategoryAccessGateway $categoryAccessGateway,
    ) {}

    public function execute(): array
    {
        //--------------------------------------------------------------------------
        // USECASE -> Obtener categorías activas
        //--------------------------------------------------------------------------

        return $this->categoryAccessGateway->findAllActive();
    }
}

