<?php

namespace App\Modules\Catalog\Product\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class InvalidBrandException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 404,
            errorCode: 'INVALID_BRAND',
            message: 'La marca seleccionada no existe o no está activa.'
        );
    }
}
