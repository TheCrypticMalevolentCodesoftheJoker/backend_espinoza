<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\ImageInterface;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblImage;

class EloquentImageRepository implements ImageInterface
{
    public function save(ImageEntity $imageEntity): void
    {
        TblImage::create([
            'product_id' => $imageEntity->getProductId(),
            'url' => $imageEntity->getUrl(),
            'type' => $imageEntity->getType(),
        ]);
    }
}
