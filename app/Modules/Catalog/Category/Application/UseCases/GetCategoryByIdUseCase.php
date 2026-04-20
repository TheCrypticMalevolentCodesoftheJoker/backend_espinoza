<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Application\DTOs\CategoryDTO;
use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryId;

class GetCategoryByIdUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface
    ) {}
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    public function Execute(string $id): CategoryDTO
    {
        $categoryId = new CategoryId($id);

        $category = $this->categoryInterface->findById($categoryId->value());

        if (!$category) {
            throw new \DomainException('Categoría no encontrada');
        }

        return CategoryMapper::toDTO($category);
    }
}
