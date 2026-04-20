<?php

namespace Database\Seeders;

use App\Modules\Catalog\Brand\Infrastructure\Persistence\Eloquent\Models\TblBrand;
use Illuminate\Database\Seeder;

class TblBrandSeeder extends Seeder
{
    public function run(): void
    {
        TblBrand::factory()->count(10)->create();
    }
}
