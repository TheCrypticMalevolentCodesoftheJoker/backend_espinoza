<?php

namespace App\Modules\Auth\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class TokenExpiredOrInvalidException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 401,
            errorCode: 'AUTH_SESSION_EXPIRED',
            message: 'No autenticado.'
        );
    }
}
