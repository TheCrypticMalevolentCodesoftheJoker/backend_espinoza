<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;

class ProductFile
{
    private UploadedFile $value;

    public function __construct(UploadedFile $file)
    {
        if (!$file->isValid()) {
            throw ValidationException::withMessages([
                'multimedia' => 'El archivo excede el tamaño máximo permitido por el servidor.'
            ]);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $sizeInMb = $file->getSize() / 1024 / 1024;

        if ($extension === 'glb') {
            if ($sizeInMb > 10) {
                throw ValidationException::withMessages([
                    'multimedia' => 'El archivo 3D (.glb) no puede superar los 10MB.'
                ]);
            }
        } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
            if ($sizeInMb > 5) {
                throw ValidationException::withMessages([
                    'multimedia' => 'La imagen no puede superar los 5MB.'
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'multimedia' => 'Formato de archivo no permitido.'
            ]);
        }

        $this->value = $file;
    }

    public function value(): UploadedFile
    {
        return $this->value;
    }
}
