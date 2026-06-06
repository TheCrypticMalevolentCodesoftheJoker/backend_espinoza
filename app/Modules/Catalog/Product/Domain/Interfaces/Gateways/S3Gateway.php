<?php

//--------------------------------------------------------------------------
// S3Gateway: Contrato para la carga y gestión de archivos en almacenamiento en la nube S3
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Interfaces\Gateways;

use Illuminate\Http\UploadedFile;

interface S3Gateway
{
    public function upload(int $productId, UploadedFile $file): array;
    public function deleteAll(int $productId): void;
}
