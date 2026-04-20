<?php

namespace App\Modules\Catalog\Brand\Application\UseCases;

use App\Modules\Catalog\Brand\Application\Mappers\BrandMapper;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;

class ListBrandsUseCase
{
    public function __construct(
        private BrandInterface $repository
    ) {}
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    public function execute(): array
    {
        $brands = $this->repository->findAll();
        return BrandMapper::toDTOArray($brands);
    }
}
