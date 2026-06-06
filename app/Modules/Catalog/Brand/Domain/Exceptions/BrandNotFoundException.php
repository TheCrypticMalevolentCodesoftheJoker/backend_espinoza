<?php

//--------------------------------------------------------------------------
// BrandNotFoundException: Excepción lanzada cuando una marca solicitada no existe
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class BrandNotFoundException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 404,
            errorCode: 'BRAND_NOT_FOUND',
            message: 'Marca no encontrada.'
        );
    }
}
