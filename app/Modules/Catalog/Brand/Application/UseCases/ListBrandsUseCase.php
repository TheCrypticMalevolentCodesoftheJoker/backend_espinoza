<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;

class ListBrandsUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    public function execute(): array
    {
        $brands = $this->brandInterface->findAll();

        $total = $this->brandInterface->countAll();
        $activos = $this->brandInterface->countActive();
        $inactivos = $this->brandInterface->countInactive();

        $dto = BrandMapper::toDTOArray($brands);

        return [
            'brands' => $dto,
            'stats' => [
                'total' => $total,
                'activos' => $activos,
                'inactivos' => $inactivos,
            ]
        ];
    }
}
