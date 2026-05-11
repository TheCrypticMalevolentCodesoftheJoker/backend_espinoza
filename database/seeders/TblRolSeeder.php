<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Role\Infrastructure\Persistence\Eloquent\Models\TblRol;

class TblRolSeeder extends Seeder
{
    public function run(): void
    {
        //----------------------------------------------------------------------
        // REGISTRO DE ROLES
        //----------------------------------------------------------------------

        TblRol::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Administrador',
                'description' => 'Acceso total al sistema',
                'status' => true,
            ]
        );
    }
}
