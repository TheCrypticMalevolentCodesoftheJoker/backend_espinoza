<?php

//--------------------------------------------------------------------------
// ArEventEntity: Entidad que modela la lógica y propiedades de un evento AR
//--------------------------------------------------------------------------

namespace App\Modules\Analytics\Domain\Entities;

use App\Modules\Analytics\Domain\ValueObjects\SessionId;
use App\Modules\Analytics\Domain\ValueObjects\EventType;

class ArEventEntity
{
    private function __construct(
        private int $id,
        private SessionId $sessionId,
        private int $productId,
        private EventType $eventType,
        private ?int $durationSeconds,
        private ?\DateTime $createdAt,
        private ?\DateTime $updatedAt,
    ) {}

    public static function create(
        SessionId $sessionId,
        int $productId,
        EventType $eventType,
        ?int $durationSeconds,
    ): self {
        return new self(
            id: 0,
            sessionId: $sessionId,
            productId: $productId,
            eventType: $eventType,
            durationSeconds: $durationSeconds,
            createdAt: null,
            updatedAt: null,
        );
    }

    public static function reconstitute(
        int $id,
        SessionId $sessionId,
        int $productId,
        EventType $eventType,
        ?int $durationSeconds,
        ?\DateTime $createdAt,
        ?\DateTime $updatedAt,
    ): self {
        return new self(
            id: $id,
            sessionId: $sessionId,
            productId: $productId,
            eventType: $eventType,
            durationSeconds: $durationSeconds,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSessionId(): string
    {
        return $this->sessionId->value();
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getEventType(): string
    {
        return $this->eventType->value();
    }

    public function getDurationSeconds(): ?int
    {
        return $this->durationSeconds;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }
}
