<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Image;

use Illuminate\Validation\ValidationException;

class ImageType
{
    public const CATEGORY_IMAGE = 'image';
    public const CATEGORY_MODEL = 'model';

    private const VALID_EXTENSIONS = ['png', 'jpg', 'webp', 'glb'];

    private string $extension;
    private string $category;

    public function __construct(string $extension)
    {
        $normalized = strtolower(trim($extension));

        if ($normalized === self::CATEGORY_IMAGE || $normalized === self::CATEGORY_MODEL) {
            $this->extension = $normalized;
            $this->category = $normalized;
            return;
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> La extensión debe ser una de las permitidas (png, jpg, webp, glb)
        //--------------------------------------------------------------------------
        if (!in_array($normalized, self::VALID_EXTENSIONS, true)) {
            throw ValidationException::withMessages([
                'type' => 'El tipo de archivo debe ser "png", "jpg", "webp" o "glb".'
            ]);
        }

        $this->extension = $normalized;
        $this->category = ($normalized === 'glb') ? self::CATEGORY_MODEL : self::CATEGORY_IMAGE;
    }

    public function extension(): string
    {
        return $this->extension;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function isModel(): bool
    {
        return $this->category === self::CATEGORY_MODEL;
    }

    public function isImage(): bool
    {
        return $this->category === self::CATEGORY_IMAGE;
    }
}
