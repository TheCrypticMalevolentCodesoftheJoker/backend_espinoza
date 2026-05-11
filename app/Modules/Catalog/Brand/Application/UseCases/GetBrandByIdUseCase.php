<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Application\DTOs\BrandDTO;
use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\Exceptions\BrandNotFoundException;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandId;


class GetBrandByIdUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    public function execute(int $id): BrandDTO
    {
        $brand = $this->brandInterface->findById($id);

        if (!$brand) {
            throw new BrandNotFoundException();
        }

        return BrandMapper::toDTO($brand);
    }
}

