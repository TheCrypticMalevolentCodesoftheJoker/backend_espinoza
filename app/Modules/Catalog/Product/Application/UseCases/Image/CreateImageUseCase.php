<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Image;

use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\ImageInterface;

class CreateImageUseCase
{
    public function __construct(
        private ImageInterface $imageInterface
    ) {}


    public function execute(int $productId, array $images): void
    {
        foreach ($images as $imageDTO) {

            $entity = ImageEntity::create(
                productId: $productId,
                url: $imageDTO->url,
                type: $imageDTO->type
            );

            $this->imageInterface->save($entity);
        }
    }
}
