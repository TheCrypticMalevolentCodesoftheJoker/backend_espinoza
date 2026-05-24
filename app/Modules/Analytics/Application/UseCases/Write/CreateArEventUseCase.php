<?php

namespace App\Modules\Analytics\Application\UseCases\Write;

use App\Modules\Analytics\Application\DTOs\Write\StoreArEventDTO;
use App\Modules\Analytics\Domain\Entities\ArEventEntity;
use App\Modules\Analytics\Domain\Interfaces\AnalyticsInterface;
use App\Modules\Analytics\Domain\ValueObjects\SessionId;
use App\Modules\Analytics\Domain\ValueObjects\EventType;

class CreateArEventUseCase
{
    //--------------------------------------------------------------------------
    // CONSTRUCTOR -> Inicializa el caso de uso con el repositorio
    //--------------------------------------------------------------------------
    public function __construct(
        private AnalyticsInterface $analyticsRepository,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUCIÓN -> Valida y persiste el evento de interacción AR
    //--------------------------------------------------------------------------
    public function execute(StoreArEventDTO $dto): void
    {
        $sessionId = new SessionId($dto->sessionId);
        $eventType = new EventType($dto->eventType);

        $entity = ArEventEntity::create(
            sessionId: $sessionId,
            productId: $dto->productId,
            eventType: $eventType,
            durationSeconds: $dto->durationSeconds,
        );

        $this->analyticsRepository->save($entity);
    }
}
