<?php

namespace App\Modules\Catalog\Brand\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class BrandName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalized = trim($name);

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> No puede estar vacío
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'name' => 'El nombre de la marca no puede estar vacío.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Solo caracteres válidos
        //--------------------------------------------------------------------------
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
