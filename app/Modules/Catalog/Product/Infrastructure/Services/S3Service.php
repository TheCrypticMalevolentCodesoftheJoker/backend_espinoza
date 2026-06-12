<?php
//--------------------------------------------------------------------------
// S3Service: Implementación del gateway de almacenamiento para archivos multimedia.
// Gestiona la carga, conversión a WebP y eliminación de imágenes y modelos 3D.
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Infrastructure\Services;

use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\S3Gateway;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class S3Service implements S3Gateway
{
    //--------------------------------------------------------------------------
    // ALMACENAMIENTO -> Subir archivo multimedia (imagen o modelo 3D)
    //--------------------------------------------------------------------------
    public function upload(int $productId, UploadedFile $file): array
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename  = (string) Str::uuid();

        if ($extension === 'glb') {
            //--------------------------------------------------------------------------
            // MODELO 3D -> Guardar archivo .glb sin conversión
            //--------------------------------------------------------------------------
            $targetDir      = public_path("product/models/{$productId}");
            $targetFilename = "{$filename}.glb";

            $this->ensureDirectory($targetDir);
            $file->move($targetDir, $targetFilename);

            return [
                'url'  => asset("public/product/models/{$productId}/{$targetFilename}"),
                'type' => 'glb',
            ];
        }

        //--------------------------------------------------------------------------
        // IMÁGENES -> Conversión a WebP con GD; fallback sin conversión si GD no está.
        //--------------------------------------------------------------------------
        $targetDir = public_path("product/images/{$productId}");

        if (!extension_loaded('gd')) {
            //--------------------------------------------------------------------------
            // GD no disponible: guardar tal cual y alertar. Activar extension=gd en php.ini.
            //--------------------------------------------------------------------------
            Log::warning('S3Service: extensión GD no disponible, imagen guardada sin conversión WebP.');

            $targetFilename = "{$filename}.{$extension}";
            $this->ensureDirectory($targetDir);
            $file->move($targetDir, $targetFilename);

            return [
                'url'  => asset("public/product/images/{$productId}/{$targetFilename}"),
                'type' => $extension,
            ];
        }

        //--------------------------------------------------------------------------
        // Cargar imagen desde el archivo temporal según su extensión.
        // El @ suprime advertencias de GD; el resultado false es verificado después.
        //--------------------------------------------------------------------------
        $sourcePath = $file->getRealPath();
        $image = match ($extension) {
            'jpg', 'jpeg' => @imagecreatefromjpeg($sourcePath),
            'png'         => @imagecreatefrompng($sourcePath),
            'webp'        => @imagecreatefromwebp($sourcePath),
            default       => throw new \InvalidArgumentException(
                "Formato de imagen '{$extension}' no soportado para conversión WebP."
            ),
        };

        if ($image === false) {
            throw new \RuntimeException(
                "No se pudo cargar la imagen '{$file->getClientOriginalName()}' para conversión. " .
                "Verifique que el archivo no esté corrupto."
            );
        }

        //--------------------------------------------------------------------------
        // Preservar transparencia para PNG y WebP (evita fondo negro en imágenes RGBA).
        //--------------------------------------------------------------------------
        if (in_array($extension, ['png', 'webp'], true)) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }

        $webpFilename = "{$filename}.webp";
        $absolutePath = "{$targetDir}/{$webpFilename}";

        $this->ensureDirectory($targetDir);

        $saved = imagewebp($image, $absolutePath, 80);
        imagedestroy($image);

        if (!$saved) {
            throw new \RuntimeException(
                "No se pudo guardar la imagen WebP en '{$absolutePath}'. " .
                "Verifique los permisos de escritura en el directorio."
            );
        }

        return [
            'url'  => asset("public/product/images/{$productId}/{$webpFilename}"),
            'type' => 'webp',
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

    //--------------------------------------------------------------------------
    // UTILIDAD -> Crear directorio si no existe
    //--------------------------------------------------------------------------
    private function ensureDirectory(string $path): void
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }
}
