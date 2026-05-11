<?php

namespace App\Modules\Catalog\Product\Application\UseCases;

use App\Modules\Catalog\Product\Domain\Interfaces\BrandAccessGateway;

class GetActiveBrandsUseCase
{
    public function __construct(
        private BrandAccessGateway $brandAccessGateway,
    ) {}

    public function execute(): array
    {
        //--------------------------------------------------------------------------
        // USECASE -> Obtener marcas activas
        //--------------------------------------------------------------------------

        return $this->brandAccessGateway->findAllActive();
    }
}

