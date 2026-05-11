<?php

namespace App\Modules\User\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class UserRoleId
{
    private int $value;

    public function __construct(int $roleId)
    {
        if ($roleId <= 0) {
            throw new ValidationAppException(
                field: 'role_id',
                message: 'El rol seleccionado no es válido.'
            );
        }

        $this->value = $roleId;
    }

    public function value(): int
    {
        return $this->value;
    }
}
