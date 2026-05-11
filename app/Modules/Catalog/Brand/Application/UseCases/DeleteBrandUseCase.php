<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Domain\Exceptions\BrandNotFoundException;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;

class DeleteBrandUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    public function execute(int $id): void
    {
        $entity = $this->brandInterface->findById($id);

        if (!$entity) {
            throw new BrandNotFoundException();
        }

        $this->brandInterface->delete($entity->getId());
    }
}

