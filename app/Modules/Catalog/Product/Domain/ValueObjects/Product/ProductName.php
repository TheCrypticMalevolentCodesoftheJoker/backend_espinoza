<?php

//--------------------------------------------------------------------------
// ProductName: Objeto de valor que representa y valida el nombre de un producto
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Product;

use Illuminate\Validation\ValidationException;

class ProductName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalized = trim($name);

        //--------------------------------------------------------------------------
        // Validación: Reglas de integridad para el nombre del producto
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'name' => 'El nombre del producto no puede estar vacío.'
            ]);
        }

        if (!preg_match('/^[\pL\pN\s\-_.]+$/u', $normalized)) {
            throw ValidationException::withMessages([
                'name' => 'El nombre del producto solo puede contener letras, números, espacios, guiones, guiones bajos y puntos.'
            ]);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
