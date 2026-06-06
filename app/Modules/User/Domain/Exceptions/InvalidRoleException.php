<?php
//--------------------------------------------------------------------------
// InvalidRoleException: Excepción de negocio cuando el rol asignado no existe (404).
//--------------------------------------------------------------------------

namespace App\Modules\User\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class InvalidRoleException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 404,
            errorCode: 'INVALID_ROLE',
            message: 'El rol no existe.'
        );
    }
}
