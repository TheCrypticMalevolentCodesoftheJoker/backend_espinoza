<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Application\DTOs\BrandDTO;
use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandId;

class DeactivateBrandUseCase
{
    public function __construct(
        private BrandInterface $brandInterface
    ) {}

    public function execute(string $id): BrandDTO
    {
        $brandId = new BrandId($id);

        $entity = $this->brandInterface->findById($brandId->value());

        if (!$entity) {
            throw new \DomainException('Marca no encontrada');
        }

        $entity->deactivate();

        $updated = $this->brandInterface->update($entity);

        return BrandMapper::toDTO($updated);
    }
}
