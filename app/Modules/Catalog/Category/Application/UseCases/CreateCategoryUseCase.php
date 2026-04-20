<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Application\DTOs\CategoryDTO;
use App\Modules\Catalog\Category\Application\DTOs\StoreCategoryDTO;
use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Entities\CategoryEntity;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryName;

class CreateCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface
    ) {}
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    public function Execute(StoreCategoryDTO  $storeCategoryDTO): CategoryDTO
    {
        $categoryName = new CategoryName($storeCategoryDTO->name);

        $existing = $this->categoryInterface->findByName($categoryName->value());

        if ($existing) {
            throw new \DomainException('La categoría ya existe');
        }
        $categoryEntity = CategoryEntity::create(
            name: $categoryName
        );

        $category = $this->categoryInterface->save($categoryEntity);

        return CategoryMapper::toDTO($category);
    }
}
