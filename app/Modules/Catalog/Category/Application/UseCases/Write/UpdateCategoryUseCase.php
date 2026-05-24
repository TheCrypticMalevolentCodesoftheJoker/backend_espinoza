<?php

namespace App\Modules\Catalog\Category\Application\UseCases\Write;

use App\Modules\Catalog\Category\Application\DTOs\Write\UpdateCategoryDTO;
use App\Modules\Catalog\Category\Domain\Exceptions\CategoryAlreadyExistsException;
use App\Modules\Catalog\Category\Domain\Exceptions\CategoryNotFoundException;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryName;

class UpdateCategoryUseCase
{
    public function __construct(
        private CategoryInterface $categoryInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Actualizar una categoría existente
    //--------------------------------------------------------------------------
    public function execute(int $id, UpdateCategoryDTO $updateCategoryDTO): void
    {
        $entity = $this->categoryInterface->findById($id);

        if (!$entity) {
            throw new CategoryNotFoundException();
        }

        $newName = new CategoryName($updateCategoryDTO->name);

        $existing = $this->categoryInterface->findByName($newName->value());
        if ($existing && $existing->getId() !== $entity->getId()) {
            throw new CategoryAlreadyExistsException();
        }

        $entity->rename($newName);

        $this->categoryInterface->update($entity);
    }
}
