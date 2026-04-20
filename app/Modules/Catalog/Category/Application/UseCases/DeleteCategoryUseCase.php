<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryId;

class DeleteCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface
    ) {}

    public function execute(string $id): void
    {
        $categoryId = new CategoryId($id);

        $entity = $this->categoryInterface->findById($categoryId->value());

        if (!$entity) {
            throw new \DomainException('Categoría no encontrada');
        }

        $this->categoryInterface->delete($entity->getId());
    }
}
