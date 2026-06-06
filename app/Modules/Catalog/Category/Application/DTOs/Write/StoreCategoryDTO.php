<?php

//--------------------------------------------------------------------------
// StoreCategoryDTO: Estructura de datos para la creación de una categoría
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Application\DTOs\Write;

class StoreCategoryDTO
{
    public function __construct(
        public string $name
    ) {}
}
