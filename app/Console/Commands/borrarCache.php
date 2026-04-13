<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class borrarCache extends Command
{
    protected $signature = 'borrarCache';
    public function handle()
    {
        $this->info('✨ Iniciando limpieza de cache en bootstrap...');

        $this->info('💫 Limpiando Bootstrap: config...');
        $this->call('config:clear');
        $this->call('config:cache');

        $this->info('💫 Limpiando Bootstrap: route...');
        $this->call('route:clear');
        $this->call('route:cache');

        $this->info('💫 Reejecutando auto-discovery de paquetes y Service Providers...');
        $this->call('package:discover');
        
        $this->info('✅ Sistema optimizado correctamente.');
        $this->info('❗Ejecutar manualmente: composer dump-autoload.');
    }
}
