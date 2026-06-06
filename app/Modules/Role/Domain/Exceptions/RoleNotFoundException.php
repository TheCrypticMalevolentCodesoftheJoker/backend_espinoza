<?php
//--------------------------------------------------------------------------
// RoleNotFoundException: Excepción de negocio cuando el rol solicitado no existe (404).
//--------------------------------------------------------------------------

namespace App\Modules\Role\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class RoleNotFoundException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 404,
            errorCode: 'ROLE_NOT_FOUND',
            message: 'Rol no encontrado.'
        );
    }
}
