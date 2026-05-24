<?php

namespace App\Modules\Role\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class RoleName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalized = trim($name);

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> No puede estar vacío del todo
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'name' => 'El nombre del rol no puede estar vacío.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Solo caracteres alfabéticos y símbolos permitidos
        //--------------------------------------------------------------------------
        if (!preg_match('/^[\pL\s\-_]+$/u', $normalized)) {
            throw ValidationException::withMessages([
                'name' => 'El nombre del rol solo puede contener letras, espacios, guiones y guiones bajos.'
            ]);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
