<?php

namespace App\Modules\Catalog\Brand\Application\UseCases\Read;

use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;

class ListBrandsUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Listar todas las marcas
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $brands = $this->brandInterface->findAll();

        return BrandMapper::toDTOArray($brands);
    }
}
