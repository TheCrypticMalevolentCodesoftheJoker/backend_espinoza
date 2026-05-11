<?php

namespace App\Modules\Catalog\Category\Application\UseCases;

use App\Modules\Catalog\Category\Application\Mappers\CategoryMapper;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;

class ListCategoriesUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    public function execute(): array
    {
        $categories = $this->categoryInterface->findAll();

        $total = $this->categoryInterface->countAll();
        $activos = $this->categoryInterface->countActive();
        $inactivos = $this->categoryInterface->countInactive();

        $dto = CategoryMapper::toDTOArray($categories);

        return [
            'categories' => $dto,
            'stats' => [
                'total' => $total,
                'activos' => $activos,
                'inactivos' => $inactivos,
            ]
        ];
    }
}
