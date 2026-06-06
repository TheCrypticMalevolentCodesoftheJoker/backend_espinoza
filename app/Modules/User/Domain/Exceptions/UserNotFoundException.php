<?php
//--------------------------------------------------------------------------
// UserNotFoundException: Excepción de negocio cuando el usuario solicitado no existe (404).
//--------------------------------------------------------------------------

namespace App\Modules\User\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class UserNotFoundException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 404,
            errorCode: 'USER_NOT_FOUND',
            message: 'El usuario no fue encontrado.'
        );
    }
}
