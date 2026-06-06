<?php

//--------------------------------------------------------------------------
// InvalidCategoryException: Excepción de negocio para marcar un identificador de categoría inválido o inactivo
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Exceptions\Gateways;

use App\Shared\Exceptions\BusinessAppException;

class InvalidCategoryException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 404,
            errorCode: 'INVALID_CATEGORY',
            message: 'La categoría seleccionada no existe o no está activa.'
        );
    }
}
