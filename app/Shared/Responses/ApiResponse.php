<?php

namespace App\Shared\Responses;

use App\Shared\DTOs\ApiResponseDTO;

class ApiResponse
{
    public static function success(
        int $statusCode = 200,
        string $errorCode = '0',
        string $message = 'OK',
        mixed $data = null,
    ) {
        return response()->json(
            (new ApiResponseDTO(
                success: true,
                errorCode: $errorCode,
                message: $message,
                data: $data
            ))->toArray(),
            $statusCode
        );
    }

    public static function error(
        int $statusCode = 500,
        string $errorCode = '0',
        string $message = 'ERROR',
        mixed $data = null,
    ) {
        return response()->json(
            (new ApiResponseDTO(
                success: false,
                errorCode: $errorCode,
                message: $message,
                data: $data
            ))->toArray(),
            $statusCode
        );
    }
}
