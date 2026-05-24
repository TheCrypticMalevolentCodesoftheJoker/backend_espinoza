<?php

namespace App\Modules\User\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class UserPassword
{
    private string $value;

    public function __construct(string $password)
    {
        $password = trim($password);

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> No puede estar vacío
        //--------------------------------------------------------------------------
        if ($password === '') {
            throw ValidationException::withMessages([
                'password' => 'La contraseña no puede estar vacía.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Al menos una mayúscula
        //--------------------------------------------------------------------------
        if (!preg_match('/[A-Z]/', $password)) {
            throw ValidationException::withMessages([
                'password' => 'La contraseña debe contener al menos una letra mayúscula.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Al menos una minúscula
        //--------------------------------------------------------------------------
        if (!preg_match('/[a-z]/', $password)) {
            throw ValidationException::withMessages([
                'password' => 'La contraseña debe contener al menos una letra minúscula.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Al menos un número
        //--------------------------------------------------------------------------
        if (!preg_match('/[0-9]/', $password)) {
            throw ValidationException::withMessages([
                'password' => 'La contraseña debe contener al menos un número.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Al menos un símbolo
        //--------------------------------------------------------------------------
        if (!preg_match('/[\W_]/', $password)) {
            throw ValidationException::withMessages([
                'password' => 'La contraseña debe contener al menos un símbolo.'
            ]);
        }

        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }
}
