<?php

namespace App\Modules\Catalog\Category\Domain\Exceptions;

use App\Shared\Exceptions\BusinessAppException;

class CategoryAlreadyExistsException extends BusinessAppException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 409,
            errorCode: 'CATEGORY_ALREADY_EXISTS',
            message: 'La categoría ya existe.'
        );
    }
}
