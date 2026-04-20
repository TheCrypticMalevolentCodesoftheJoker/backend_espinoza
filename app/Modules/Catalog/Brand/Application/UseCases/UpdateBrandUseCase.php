<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Application\DTOs\BrandDTO;
use App\Modules\Catalog\Brand\Application\DTOs\UpdateBrandDTO;
use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandId;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandName;

class UpdateBrandUseCase
{
    public function __construct(
        private BrandInterface $brandInterface
    ) {}

    public function execute(string $id, UpdateBrandDTO $dto): BrandDTO
    {
        $brandId = new BrandId($id);

        $entity = $this->brandInterface->findById($brandId->value());

        if (!$entity) {
            throw new \DomainException('Marca no encontrada');
        }

        $brandName = new BrandName($dto->name);

        $existing = $this->brandInterface->findByName($brandName->value());

        if ($existing) {
            throw new \DomainException('La marca ya existe');
        }

        $entity->rename(new BrandName($dto->name));


        $updated = $this->brandInterface->update($entity);

        return BrandMapper::toDTO($updated);
    }
}
