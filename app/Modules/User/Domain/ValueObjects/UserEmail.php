<?php

namespace App\Modules\User\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class UserEmail
{
    private string $value;

    public function __construct(string $email)
    {
        $normalized = trim($email);

        if ($normalized === '') {
            throw new ValidationAppException(
                field: 'email',
                message: 'El email del usuario no puede estar vacío.'
            );
        }

        if (!filter_var($normalized, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationAppException(
                field: 'email',
                message: 'El email no tiene un formato válido.'
            );
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
