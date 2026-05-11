<?php

namespace App\Modules\Role\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class RoleAlreadyExistsException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 409,
            errorCode: 'ROLE_ALREADY_EXISTS',
            message: 'El rol ya existe.'
        );
    }
}
