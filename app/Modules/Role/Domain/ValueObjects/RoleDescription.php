<?php

namespace App\Modules\Role\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class RoleDescription
{
    private ?string $value;

    public function __construct(?string $description)
    {
        if ($description === null) {
            $this->value = null;
            return;
        }

        $normalized = trim($description);

        if ($normalized === '') {
            $this->value = null;
            return;
        }

        $this->value = $normalized;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
