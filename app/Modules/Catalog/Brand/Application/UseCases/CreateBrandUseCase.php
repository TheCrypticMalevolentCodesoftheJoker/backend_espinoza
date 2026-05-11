<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Application\DTOs\StoreBrandDTO;
use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;
use App\Modules\Catalog\Brand\Domain\Exceptions\BrandAlreadyExistsException;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandName;

class CreateBrandUseCase
{
    public function __construct(
        private BrandInterface $brandInterface,
    ) {}

    public function execute(StoreBrandDTO $storeBrandDTO): void
    {
        $name = new BrandName($storeBrandDTO->name);

        if ($this->brandInterface->findByName($name->value())) {
            throw new BrandAlreadyExistsException();
        }

        $entity = BrandEntity::create(name: $name);

        $this->brandInterface->save($entity);
    }
}

