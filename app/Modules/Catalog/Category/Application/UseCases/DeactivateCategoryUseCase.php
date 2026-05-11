<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Domain\Exceptions\CategoryNotFoundException;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class DeactivateCategoryUseCase
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

        $entity->deactivate();

        $this->categoryInterface->update($entity);
    }
}
