<?php

//--------------------------------------------------------------------------
// StoreArEventDTO: Estructura de datos para el registro de eventos AR
//--------------------------------------------------------------------------

namespace App\Modules\Analytics\Application\DTOs\Write;

class StoreArEventDTO
{
    public function __construct(
        public string $sessionId,
        public int $productId,
        public string $eventType,
        public ?int $durationSeconds,
    ) {}
}
