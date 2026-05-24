<?php

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
    // EJECUTAR CASO DE USO -> Obtener una marca por ID
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
