<?php

namespace App\Shared\Exceptions;

class ValidationAppException extends \Exception
{
    public function __construct(
        protected string $field,
        string $message,
    ) {
        parent::__construct(message: $message);
    }

    public function errors(): array
    {
        return [
            $this->field => $this->getMessage()
        ];
    }
}
