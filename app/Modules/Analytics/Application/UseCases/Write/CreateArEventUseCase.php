<?php

//--------------------------------------------------------------------------
// CreateArEventUseCase: Orquestación del flujo de registro de un evento AR
//--------------------------------------------------------------------------

namespace App\Modules\Analytics\Application\UseCases\Write;

use App\Modules\Analytics\Application\DTOs\Write\StoreArEventDTO;
use App\Modules\Analytics\Domain\Entities\ArEventEntity;
use App\Modules\Analytics\Domain\Interfaces\AnalyticsInterface;
use App\Modules\Analytics\Domain\ValueObjects\SessionId;
use App\Modules\Analytics\Domain\ValueObjects\EventType;

class CreateArEventUseCase
{
    public function __construct(
        private AnalyticsInterface $analyticsRepository,
    ) {}

    //--------------------------------------------------------------------------
    // Orquestación: Construcción y persistencia de la entidad de interacción AR
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
