<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Domain\Exceptions\CategoryNotFoundException;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class ActivateCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    public function execute(int $id): void
    {
        $entity = $this->categoryInterface->findById($id);

        if (!$entity) {
            throw new CategoryNotFoundException();
        }

        $entity->activate();

        $this->categoryInterface->update($entity);
    }
}
