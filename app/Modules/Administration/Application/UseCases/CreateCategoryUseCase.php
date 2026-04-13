<?php

namespace App\Modules\Administration\Application\UseCases;

use App\Modules\Administration\Application\DTOs\CategoryDTO;
use App\Modules\Administration\Application\DTOs\CreateCategoryDTO;
use App\Modules\Administration\Application\Mappers\CategoryMapper;
use App\Modules\Administration\Domain\Entities\CategoryEntity;
use App\Modules\Administration\Domain\Interfaces\CategoryInterface;
use App\Modules\Administration\Domain\ValueObjects\CategoryName;

class CreateCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface
    ) {}
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    public function Execute(CreateCategoryDTO  $createCategoryDTO): CategoryDTO
    {
        $categoryName = new CategoryName($createCategoryDTO->name);

        $categoryEntity = CategoryEntity::create(
            $categoryName
        );

        $category = $this->categoryInterface->save($categoryEntity);

        return CategoryMapper::toDTO($category);
    }
}
