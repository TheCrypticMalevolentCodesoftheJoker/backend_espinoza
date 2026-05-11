<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Application\DTOs\StoreCategoryDTO;
use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;
use App\Modules\Catalog\Category\Domain\Exceptions\CategoryAlreadyExistsException;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryName;

class CreateCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    public function execute(StoreCategoryDTO $storeCategoryDTO): void
    {
        $name = new CategoryName($storeCategoryDTO->name);

        if ($this->categoryInterface->findByName($name->value())) {
            throw new CategoryAlreadyExistsException();
        }

        $entity = CategoryEntity::create(name: $name);

        $this->categoryInterface->save($entity);
    }
}
