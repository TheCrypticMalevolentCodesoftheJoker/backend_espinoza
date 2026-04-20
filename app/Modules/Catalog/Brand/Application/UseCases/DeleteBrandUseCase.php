<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandId;

class DeleteBrandUseCase
{
    public function __construct(
        private BrandInterface $brandInterface
    ) {}

    public function execute(string $id): void
    {
        $brandId = new BrandId($id);

        $entity = $this->brandInterface->findById($brandId->value());

        if (!$entity) {
            throw new \DomainException('Marca no encontrada');
        }

        $this->brandInterface->delete($brandId->value());
    }
}
