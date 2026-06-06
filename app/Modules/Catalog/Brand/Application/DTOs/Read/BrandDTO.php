<?php

//--------------------------------------------------------------------------
// BrandDTO: Estructura de datos para la visualización de detalles de una marca
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Application\DTOs\Read;

class BrandDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $status,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}
}
