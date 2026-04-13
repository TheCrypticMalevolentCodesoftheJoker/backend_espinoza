<?php

namespace Database\Seeders;

use App\Models\TblProduct;
use Illuminate\Database\Seeder;

class TblProductSeeder extends Seeder
{
    public function run(): void
    {
        TblProduct::factory()->count(10)->create();
    }
}
