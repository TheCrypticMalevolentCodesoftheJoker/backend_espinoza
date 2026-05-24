<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Product;

use Illuminate\Validation\ValidationException;

class ProductName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalized = trim($name);

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> El nombre del producto no puede estar vacío
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'name' => 'El nombre del producto no puede estar vacío.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Solo caracteres permitidos (letras, números, espacios, guiones, guiones bajos, puntos)
        //--------------------------------------------------------------------------
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
