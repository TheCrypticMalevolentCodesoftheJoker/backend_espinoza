<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Application\DTOs\BrandDTO;
use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandId;

class GetBrandByIdUseCase
{
    public function __construct(
        private BrandInterface $repository
    ) {}

    public function execute(string $id): BrandDTO
    {
        $brandId = new BrandId($id);

        $entity = $this->repository->findById($brandId->value());

        if (!$entity) {
            throw new \DomainException('Marca no encontrada');
        }

        return BrandMapper::toDTO($entity);
    }
}
