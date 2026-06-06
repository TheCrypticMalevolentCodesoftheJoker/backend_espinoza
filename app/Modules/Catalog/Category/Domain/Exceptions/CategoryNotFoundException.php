<?php

//--------------------------------------------------------------------------
// CategoryNotFoundException: Excepción de negocio lanzada cuando una categoría no existe
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class CategoryNotFoundException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 404,
            errorCode: 'CATEGORY_NOT_FOUND',
            message: 'Categoría no encontrada.'
        );
    }
}
