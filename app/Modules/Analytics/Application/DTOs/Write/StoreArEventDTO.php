<?php

namespace App\Modules\Analytics\Application\DTOs\Write;

class StoreArEventDTO
{
    //--------------------------------------------------------------------------
    // CONSTRUCTOR -> Inicializa el DTO con datos de interacción
    //--------------------------------------------------------------------------
    public function __construct(
        public string $sessionId,
        public int $productId,
        public string $eventType,
        public ?int $durationSeconds,
    ) {}
}
