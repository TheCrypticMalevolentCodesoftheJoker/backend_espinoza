<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces;

use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;

interface ImageInterface
{
    public function save(ImageEntity $imageEntity): void;
}
