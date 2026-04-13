<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // Primera tanda (datos base)
        $this->call([
            TblBrandSeeder::class,
            TblCategorySeeder::class,
        ]);
        // Segunda tanda: datos dependientes
        $this->call([
            TblProductSeeder::class,
        ]);
    }
}
