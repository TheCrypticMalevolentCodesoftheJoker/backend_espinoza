<?php

namespace App\Modules\User\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class UserName
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
                'name' => 'El nombre del usuario no puede estar vacío.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Solo caracteres válidos (letras, espacios, guiones)
        //--------------------------------------------------------------------------
        if (!preg_match('/^[\pL\s\-_]+$/u', $normalized)) {
            throw ValidationException::withMessages([
                'name' => 'El nombre del usuario solo debe contener letras.'
            ]);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
