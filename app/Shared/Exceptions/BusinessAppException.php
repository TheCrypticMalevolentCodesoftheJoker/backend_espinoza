<?php

namespace App\Shared\Exceptions;

abstract class BusinessAppException extends \Exception
{
    public function __construct(
        protected int $statusCode = 500,
        protected string $errorCode = 'NOT_FOUND',
        string $message = 'Error en la aplicación.'
    ) {
        parent::__construct($message);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}
