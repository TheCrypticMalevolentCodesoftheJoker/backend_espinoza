<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Application\DTOs\CategoryDTO;
use App\Modules\Catalog\Category\Application\DTOs\UpdateCategoryDTO;
use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryId;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryName;

class UpdateCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface
    ) {}

    public function Execute(string $id, UpdateCategoryDTO $dto): CategoryDTO
    {
        $categoryId = new CategoryId($id);

        $entity = $this->categoryInterface->findById($categoryId->value());

        if (!$entity) {
            throw new \DomainException('Categoría no encontrada');
        }

        $categoryName = new CategoryName($dto->name);

        $existing = $this->categoryInterface->findByName($categoryName->value());

        if ($existing) {
            throw new \DomainException('Ya existe la categoría');
        }

        $entity->rename($categoryName);

        $update = $this->categoryInterface->update($entity);

        return CategoryMapper::toDTO($update);
    }
}
