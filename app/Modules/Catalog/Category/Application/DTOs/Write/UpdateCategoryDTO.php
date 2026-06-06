<?php

//--------------------------------------------------------------------------
// UpdateCategoryDTO: Estructura de datos para la modificación de una categoría
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Application\DTOs\Write;

class UpdateCategoryDTO
{
    public function __construct(
        public string $name
    ) {}
}
