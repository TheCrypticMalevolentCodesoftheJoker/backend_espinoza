<?php

//--------------------------------------------------------------------------
// CategoryDTO: Estructura de datos para la visualización de detalles de una categoría
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Application\DTOs\Read;

class CategoryDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $status,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}
}
