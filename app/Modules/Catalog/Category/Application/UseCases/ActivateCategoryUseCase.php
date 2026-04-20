<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Application\DTOs\CategoryDTO;
use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryId;

class ActivateCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface
    ) {}
    //----------------------------------------------------------------------------------
    // ACTIVAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function execute(string $id): CategoryDTO
    {
        $categoryId = new CategoryId($id);

        $entity = $this->categoryInterface->findById($categoryId->value());

        if (!$entity) {
            throw new \DomainException('Categoría no encontrada');
        }

        $entity->activate();

        $updated = $this->categoryInterface->update($entity);

        return CategoryMapper::toDTO($updated);
    }
}
