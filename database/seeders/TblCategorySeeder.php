<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Catalog\Category\Infrastructure\Persistence\Eloquent\Models\TblCategory;

class TblCategorySeeder extends Seeder
{
    public function run(): void
    {
        TblCategory::factory()->count(10)->create();
    }
}
