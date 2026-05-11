<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Application\DTOs\CategoryDTO;
use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\Exceptions\CategoryNotFoundException;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryId;


class GetCategoryByIdUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    public function execute(int $id): CategoryDTO
    {
        $category = $this->categoryInterface->findById($id);

        if (!$category) {
            throw new CategoryNotFoundException();
        }

        return CategoryMapper::toDTO($category);
    }
}
