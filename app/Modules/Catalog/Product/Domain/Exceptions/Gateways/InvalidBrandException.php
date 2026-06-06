<?php

//--------------------------------------------------------------------------
// InvalidBrandException: Excepción de negocio para marcar un identificador de marca inválido o inactivo
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Exceptions\Gateways;

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
