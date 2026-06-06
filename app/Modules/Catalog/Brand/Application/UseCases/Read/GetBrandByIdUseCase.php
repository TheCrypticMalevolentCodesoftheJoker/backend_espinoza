<?php

//--------------------------------------------------------------------------
// GetBrandByIdUseCase: Consulta y obtención de una marca específica por su ID
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Application\UseCases\Read;

use App\Modules\Catalog\Brand\Application\DTOs\Read\BrandDTO;
use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\Exceptions\BrandNotFoundException;


class GetBrandByIdUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Consulta: Búsqueda de la marca por ID en persistencia
    //--------------------------------------------------------------------------
    public function execute(int $id): BrandDTO
    {
        $brand = $this->brandInterface->findById($id);

        if (!$brand) {
            throw new BrandNotFoundException();
        }

        return BrandMapper::toDTO($brand);
    }
}
