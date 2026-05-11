<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class borrarCache extends Command
{
    protected $signature = 'borrarCache';
    public function handle()
    {
        $this->info('✨ Iniciando limpieza de cache...');

        $this->call('optimize:clear');

        $this->info('💫 Config cache...');
        $this->call('config:clear');
        $this->call('config:cache');

        $this->info('💫 Route cache...');
        $this->call('route:clear');
        $this->call('route:cache');

        $this->info('💫 View cache...');
        $this->call('view:clear');

        $this->info('💫 Application cache...');
        $this->call('cache:clear');

        $this->info('💫 Package discovery...');
        $this->call('package:discover');

        $this->info('⚙ Autoload (manual)');
        $this->info('👉 composer dump-autoload');

        $this->info('✅ Sistema optimizado correctamente.');
    }
}
