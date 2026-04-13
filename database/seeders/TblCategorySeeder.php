<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblCategory;

class TblCategorySeeder extends Seeder
{
    public function run(): void
    {
        TblCategory::factory()->count(10)->create();
    }
}
