<?php

namespace App\Modules\User\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class UserPassword
{
    private string $value;

    public function __construct(string $password)
    {
        $password = trim($password);

        if ($password === '') {
            throw new ValidationAppException(
                field: 'password',
                message: 'La contraseña no puede estar vacía.'
            );
        }

        if (!preg_match('/[A-Z]/', $password)) {
            throw new ValidationAppException(
                field: 'password',
                message: 'La contraseña debe contener al menos una letra mayúscula.'
            );
        }

        if (!preg_match('/[a-z]/', $password)) {
            throw new ValidationAppException(
                field: 'password',
                message: 'La contraseña debe contener al menos una letra minúscula.'
            );
        }

        if (!preg_match('/[0-9]/', $password)) {
            throw new ValidationAppException(
                field: 'password',
                message: 'La contraseña debe contener al menos un número.'
            );
        }

        if (!preg_match('/[\W_]/', $password)) {
            throw new ValidationAppException(
                field: 'password',
                message: 'La contraseña debe contener al menos un símbolo.'
            );
        }

        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }
}
