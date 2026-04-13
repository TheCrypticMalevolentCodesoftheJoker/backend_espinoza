<?php

namespace App\Modules\Shared\Application\DTOs;

class ResponseDTO
{
    private function __construct(
        public string $type,
        public int $code,
        public string $message,
        public mixed $payload = []
    ) {}

    public static function success(int $code, string $message, mixed $payload = []): self
    {
        return new self(type: 'success', code: $code, message: $message, payload: $payload);
    }

    public static function error(int $code, string $message): self
    {
        return new self(type: 'error', code: $code, message: $message);
    }
    
    public static function info(int $code, string $message): self
    {
        return new self(type: 'info', code: $code, message: $message);
    }
}
