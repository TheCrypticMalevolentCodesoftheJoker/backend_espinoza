<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class ListCategoriesUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface
    ) {}
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//


    public function Execute(): array
    {
        $entities = $this->categoryInterface->findAll();
        return CategoryMapper::toDTOArray($entities);
    }

}
