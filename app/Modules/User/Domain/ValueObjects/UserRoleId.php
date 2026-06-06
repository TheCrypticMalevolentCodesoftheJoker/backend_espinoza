<?php
//--------------------------------------------------------------------------
// UserRoleId: Value Object con validación de identificador positivo para el rol asignado.
//--------------------------------------------------------------------------

namespace App\Modules\User\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class UserRoleId
{
    private int $value;

    public function __construct(int $roleId)
    {
        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> El ID debe ser válido (mayor a cero)
        //--------------------------------------------------------------------------
        if ($roleId <= 0) {
            throw ValidationException::withMessages([
                'roleId' => 'El rol seleccionado no es válido.'
            ]);
        }

        $this->value = $roleId;
    }

    public function value(): int
    {
        return $this->value;
    }
}
