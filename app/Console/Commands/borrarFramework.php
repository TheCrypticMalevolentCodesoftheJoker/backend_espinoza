<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class borrarFramework extends Command
{
    protected $signature = 'borrarFramework';
    protected $description = 'Limpia archivos temporales de framework';

    public function handle()
    {
        $this->info('✨ Iniciando limpieza de archivos temporales en framework...');
        $this->info('💫 Limpiando framework: cache...');
        File::cleanDirectory(storage_path('framework/cache'));

        $this->info('💫 Limpiando framework: sessions...');
        File::cleanDirectory(storage_path('framework/sessions'));

        $this->info('💫 Limpiando framework: testing...');
        File::cleanDirectory(storage_path('framework/testing'));

        $this->info('💫 Limpiando framework: views...');
        File::cleanDirectory(storage_path('framework/views'));

        $this->info('✅ Limpieza completada con éxito.');
    }
}
