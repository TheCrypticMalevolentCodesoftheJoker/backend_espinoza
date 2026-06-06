<?php
//--------------------------------------------------------------------------
// UserEmail: Value Object con validación de formato para el email del usuario.
//--------------------------------------------------------------------------

namespace App\Modules\User\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class UserEmail
{
    private string $value;

    public function __construct(string $email)
    {
        $normalized = trim($email);

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> No puede estar vacío
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'email' => 'El email del usuario no puede estar vacío.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Formato de email válido
        //--------------------------------------------------------------------------
        if (!filter_var($normalized, FILTER_VALIDATE_EMAIL)) {
            throw ValidationException::withMessages([
                'email' => 'El email no tiene un formato válido.'
            ]);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
