<?php

//--------------------------------------------------------------------------
// StoreBrandDTO: Estructura de datos para la creación de una marca
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Application\DTOs\Write;

class StoreBrandDTO
{
    public function __construct(
        public string $name
    ) {}
}

