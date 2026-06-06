<?php
//--------------------------------------------------------------------------
// S3Service: Implementación del gateway de almacenamiento para archivos multimedia.
// Gestiona la carga, conversión a WebP y eliminación de imágenes y modelos 3D.
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Infrastructure\Services;

use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\S3Gateway;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class S3Service implements S3Gateway
{
    //--------------------------------------------------------------------------
    // ALMACENAMIENTO -> Subir archivo multimedia (imagen o modelo 3D)
    //--------------------------------------------------------------------------
    public function upload(int $productId, UploadedFile $file): array
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = Str::uuid();

        if ($extension === 'glb') {
            //--------------------------------------------------------------------------
            // MODELO 3D -> Guardar archivo .glb sin conversión
            //--------------------------------------------------------------------------
            $targetDir = public_path("product/models/{$productId}");
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $targetFilename = "{$filename}.glb";
            $file->move($targetDir, $targetFilename);

            return [
                'url' => asset("public/product/models/{$productId}/{$targetFilename}"),
                'type' => 'glb'
            ];
        }

        //--------------------------------------------------------------------------
        // IMÁGENES -> Conversión a WebP y compresión
        //--------------------------------------------------------------------------
        $targetDir = public_path("product/images/{$productId}");

        if (!function_exists('imagecreatefromjpeg')) {
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $targetFilename = "{$filename}.{$extension}";
            $file->move($targetDir, $targetFilename);

            return [
                'url' => asset("public/product/images/{$productId}/{$targetFilename}"),
                'type' => $extension
            ];
        }

        $webpFilename = "{$filename}.webp";

        $image = match ($extension) {
            'png' => @imagecreatefrompng($file->getRealPath()),
            'jpg' => @imagecreatefromjpeg($file->getRealPath()),
            'webp' => @imagecreatefromwebp($file->getRealPath()),
            default => throw new \Exception("Formato de imagen no soportado para conversión."),
        };

        if (!$image) {
            throw new \Exception("No se pudo cargar la imagen para conversión.");
        }

        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $absolutePath = "{$targetDir}/{$webpFilename}";

        imagewebp($image, $absolutePath, 80);
        imagedestroy($image);

        return [
            'url' => asset("public/product/images/{$productId}/{$webpFilename}"),
            'type' => 'webp'
        ];
    }

    //--------------------------------------------------------------------------
    // ALMACENAMIENTO -> Eliminar todos los archivos de un producto
    //--------------------------------------------------------------------------
    public function deleteAll(int $productId): void
    {
        File::deleteDirectory(public_path("product/images/{$productId}"));
        File::deleteDirectory(public_path("product/models/{$productId}"));
    }
}
