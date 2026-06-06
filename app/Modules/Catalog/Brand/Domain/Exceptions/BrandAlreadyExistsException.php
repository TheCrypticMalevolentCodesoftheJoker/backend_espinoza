<?php

//--------------------------------------------------------------------------
// BrandAlreadyExistsException: Excepción lanzada por conflicto de nombres de marca duplicados
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class BrandAlreadyExistsException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 409,
            errorCode: 'BRAND_ALREADY_EXISTS',
            message: 'La marca ya existe.'
        );
    }
}
