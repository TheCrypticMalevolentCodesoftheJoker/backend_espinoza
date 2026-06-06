<?php

//--------------------------------------------------------------------------
// BrandName: Objeto de valor para la validación y encapsulación de nombres de marcas
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class BrandName
{
    private string $value;

    //--------------------------------------------------------------------------
    // Validación: Comprobaciones de integridad del nombre de marca
    //--------------------------------------------------------------------------
    public function __construct(string $name)
    {
        $normalized = trim($name);

        if ($normalized === '') {
            throw ValidationException::withMessages([
                'name' => 'El nombre de la marca no puede estar vacío.'
            ]);
        }

        if (!preg_match('/^[\pL\s\-_]+$/u', $normalized)) {
            throw ValidationException::withMessages([
                'name' => 'El nombre de la marca solo puede contener letras, espacios, guiones y guiones bajos.'
            ]);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
