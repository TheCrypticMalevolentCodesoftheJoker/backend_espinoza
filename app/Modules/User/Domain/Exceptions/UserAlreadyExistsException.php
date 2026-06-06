<?php
//--------------------------------------------------------------------------
// UserAlreadyExistsException: Excepción de negocio para conflicto de email duplicado (409).
//--------------------------------------------------------------------------

namespace App\Modules\User\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class UserAlreadyExistsException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 409,
            errorCode: 'USER_ALREADY_EXISTS',
            message: 'El usuario ya existe.'
        );
    }
}
