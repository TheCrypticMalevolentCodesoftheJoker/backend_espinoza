<?php

namespace App\Modules\Auth\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class InvalidCredentialsException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 401,
            errorCode: 'AUTH_INVALID_CREDENTIALS',
            message: 'Credenciales incorrectas.'
        );
    }
}
