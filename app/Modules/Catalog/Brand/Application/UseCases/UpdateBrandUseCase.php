<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Application\DTOs\UpdateBrandDTO;
use App\Modules\Catalog\Brand\Domain\Exceptions\BrandAlreadyExistsException;
use App\Modules\Catalog\Brand\Domain\Exceptions\BrandNotFoundException;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandName;

class UpdateBrandUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    public function execute(int $id, UpdateBrandDTO $updateBrandDTO): void
    {
        $entity = $this->brandInterface->findById($id);

        if (!$entity) {
            throw new BrandNotFoundException();
        }

        $newName = new BrandName($updateBrandDTO->name);

        $existing = $this->brandInterface->findByName($newName->value());

        if ($existing && $existing->getId() !== $entity->getId()) {
            throw new BrandAlreadyExistsException();
        }

        $entity->rename($newName);

        $this->brandInterface->update($entity);
    }
}

