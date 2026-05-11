<?php

namespace App\Modules\Catalog\Product\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class ProductAlreadyExistsException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 409,
            errorCode: 'PRODUCT_CODE_ALREADY_EXISTS',
            message: 'Ya existe un producto con ese código.'
        );
    }
}
