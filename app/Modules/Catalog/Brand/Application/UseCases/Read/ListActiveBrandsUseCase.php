<?php

//--------------------------------------------------------------------------
// ListActiveBrandsUseCase: Consulta y recuperación de marcas activas
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Application\UseCases\Read;

use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;

class ListActiveBrandsUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Consulta: Recuperación de marcas filtradas por estado activo
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $brands = $this->brandInterface->findActive();

        return BrandMapper::toDTOArray($brands);
    }
}
