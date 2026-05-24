<?php

namespace App\Shared\DTOs;

class ApiResponseDTO
{
    public function __construct(
        public bool $success,
        public string $errorCode,
        public string $message,
        public mixed $data = null
    ) {}
    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'errorCode' => $this->errorCode,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}
