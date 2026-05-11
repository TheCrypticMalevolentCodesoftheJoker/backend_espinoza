<?php

namespace App\Modules\Catalog\Product\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class ProductNotFoundException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 404,
            errorCode: 'PRODUCT_NOT_FOUND',
            message: 'Producto no encontrado.'
        );
    }
}
