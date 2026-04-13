<?php

namespace Tests\Feature;

use App\Modules\Administration\Infrastructure\Repositories\ProductoRepository;
use Tests\TestCase;

class ProductoRepositoryTest extends TestCase
{
    public function test_list_product(): void
    {
        $repository = new ProductoRepository();

        $result = $repository->listProduct();

        echo json_encode($result, JSON_PRETTY_PRINT);

        $this->assertTrue(true);
    }
}
// php artisan test --filter=ProductoRepositoryTest::test_list_product
