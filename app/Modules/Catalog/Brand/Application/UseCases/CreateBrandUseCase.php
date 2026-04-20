<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Application\DTOs\BrandDTO;
use App\Modules\Catalog\Brand\Application\DTOs\StoreBrandDTO;
use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandName;

class CreateBrandUseCase
{
    public function __construct(
        private BrandInterface $brandInterface
    ) {}

    public function execute(StoreBrandDTO $storeBrandDTO): BrandDTO
    {
        $brandName = new BrandName($storeBrandDTO->name);

        $existing = $this->brandInterface->findByName($brandName->value());

        if ($existing) {
            throw new \DomainException('La marca ya existe');
        }

        $brandEntity = BrandEntity::create($brandName);

        $brand = $this->brandInterface->save($brandEntity);

        return BrandMapper::toDTO($brand);
    }
}
