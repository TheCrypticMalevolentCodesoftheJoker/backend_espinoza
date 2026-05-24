<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Modules\User\Infrastructure\Persistence\Models\TblUser;
use Illuminate\Support\Facades\Hash;

class TblUserSeeder extends Seeder
{
    public function run(): void
    {
        //----------------------------------------------------------------------
        // REGISTRO DE USUARIO ADMINISTRADOR
        //----------------------------------------------------------------------

        TblUser::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'role_id' => 1,
                'name' => 'Administrador Sistema',
                'password' => Hash::make('Admin.12'),
                'status' => true,
            ]
        );
    }
}
