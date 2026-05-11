<?php

namespace App\Modules\User\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class UserName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalized = trim($name);

        if ($normalized === '') {
            throw new ValidationAppException(
                field: 'name',
                message: 'El nombre de la usuario no puede estar vacío.'
            );
        }

        if (!preg_match('/^[\pL\s\-_]+$/u', $normalized)) {
            throw new ValidationAppException(
                field: 'name',
                message: 'El nombre de la usuario solo debe contener letras.'
            );
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
