<?php

namespace App\Modules\Administration\Domain\Entities;

use App\Modules\Administration\Domain\ValueObjects\CategoryName;

class CategoryEntity
{
    private function __construct(
        private int $id,
        private CategoryName $name,
        private bool $status
    ) {}
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    public static function create(CategoryName $name): self
    {
        return new self(
            id: 0,
            name: $name,
            status: true
        );
    }

    public static function reconstitute(int $id, CategoryName $name, bool $status): self
    {
        return new self(
            id: $id,
            name: $name,
            status: $status
        );
    }
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name->value();
    }
    public function getStatus(): bool
    {
        return $this->status;
    }
}
