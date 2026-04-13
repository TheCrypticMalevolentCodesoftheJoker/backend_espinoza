<?php

namespace App\Modules\Administration\Application\UseCases;

use App\Modules\Administration\Application\Mappers\CategoryMapper;
use App\Modules\Administration\Domain\Interfaces\CategoryInterface;

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
