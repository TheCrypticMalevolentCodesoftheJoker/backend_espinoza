<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces\Gateways;

use Illuminate\Http\UploadedFile;

interface S3Gateway
{
    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Gestión de almacenamiento de archivos en S3
    //--------------------------------------------------------------------------
    public function upload(int $productId, UploadedFile $file): array;
    public function deleteAll(int $productId): void;
}
