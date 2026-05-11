<?php

namespace App\Shared\Exceptions;

abstract class BusinessAppException extends \Exception
{
    public function __construct(
        protected int $statusCode = 500,
        protected string $errorCode = 'APP_ERROR',
        string $message = 'Error en la aplicación.'
    ) {
        parent::__construct($message);
    }

    public function toAlert(): array
    {
        return [
            'statusCode' => $this->statusCode,
            'errorCode' => $this->errorCode,
            'message' => $this->getMessage(),
        ];
    }
}
