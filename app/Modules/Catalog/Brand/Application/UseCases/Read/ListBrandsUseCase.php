<?php

//--------------------------------------------------------------------------
// ListBrandsUseCase: Consulta y recuperación del catálogo completo de marcas
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Application\UseCases\Read;

use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;

class ListBrandsUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Consulta: Recuperación total de marcas registradas en el sistema
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $brands = $this->brandInterface->findAll();

        return BrandMapper::toDTOArray($brands);
    }
}
