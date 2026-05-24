<?php

namespace App\Modules\Catalog\Brand\Application\UseCases\Read;

use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;

class ListActiveBrandsUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Listar marcas activas
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $brands = $this->brandInterface->findActive();

        return BrandMapper::toDTOArray($brands);
    }
}
