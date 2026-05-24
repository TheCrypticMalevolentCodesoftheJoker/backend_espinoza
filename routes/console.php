<?php

use Illuminate\Support\Facades\Artisan;

// ======================================================
// CACHE / OPTIMIZE
// ======================================================
Artisan::command('borrarCache', function () {

    $this->newLine();
    $this->info('🚀 Iniciando optimización del sistema...');

    // --------------------------------------------------
    // CLEAR
    // --------------------------------------------------
    $this->info('🧹 Limpiando caches antiguas...');

    $this->call('optimize:clear');

    // --------------------------------------------------
    // CONFIG
    // --------------------------------------------------
    $this->info('⚙ Generando config cache...');

    $this->call('config:cache');

    // --------------------------------------------------
    // ROUTES
    // --------------------------------------------------
    $this->info('🛣 Generando route cache...');

    try {

        $this->call('route:cache');
    } catch (Throwable $e) {

        $this->warn('⚠ Error route cache');
        $this->line($e->getMessage());
    }

    // --------------------------------------------------
    // VIEWS
    // --------------------------------------------------
    $this->info('🖼 Generando view cache...');

    $this->call('view:cache');

    // --------------------------------------------------
    // EVENTS
    // --------------------------------------------------
    $this->info('📦 Generando event cache...');

    $this->call('event:cache');

    // --------------------------------------------------
    // APPLICATION CACHE
    // --------------------------------------------------
    $this->info('💾 Limpiando application cache...');

    try {

        $this->call('cache:clear');
    } catch (Throwable $e) {

        $this->warn('⚠ Error cache clear');
        $this->line($e->getMessage());
    }

    // --------------------------------------------------
    // PACKAGE DISCOVERY
    // --------------------------------------------------
    $this->info('🔍 Descubriendo paquetes...');

    $this->call('package:discover');

    // --------------------------------------------------
    // FINAL
    // --------------------------------------------------
    $this->newLine();

    $this->warn('👉 Ejecuta si es necesario:');
    $this->line('composer dump-autoload -o');

    if (app()->isProduction()) {

        $this->info('🌎 Entorno PRODUCCIÓN');
    } else {

        $this->info('🖥 Entorno LOCAL');
    }

    $this->info('✅ Sistema optimizado correctamente.');
})->purpose('Optimiza y limpia caches');

// ======================================================
// RESET DATABASE
// ======================================================
Artisan::command('borrarData', function () {

    $this->newLine();

    if (app()->isProduction()) {

        $this->error('❌ No permitido en producción.');
        return;
    }

    $this->info('🗑 Eliminando base de datos...');

    $this->call('migrate:fresh');

    $this->info('✅ Base de datos reiniciada.');
})->purpose('Reinicia la base de datos');

// ======================================================
// SEEDERS
// ======================================================
Artisan::command('cargarData', function () {

    $this->newLine();

    $this->info('🌱 Ejecutando seeders...');

    $this->call('db:seed', [
        '--force' => true,
    ]);

    $this->info('✅ Datos cargados correctamente.');
})->purpose('Ejecuta seeders');

// ======================================================
// FULL RESET
// ======================================================
Artisan::command('reiniciarSistema', function () {

    $this->newLine();

    if (app()->isProduction()) {

        $this->error('❌ No permitido en producción.');
        return;
    }

    $this->info('🚀 Reiniciando sistema completo...');

    // --------------------------------------------------
    // MIGRATIONS
    // --------------------------------------------------
    $this->call('migrate:fresh');

    // --------------------------------------------------
    // SEEDERS
    // --------------------------------------------------
    $this->call('db:seed', [
        '--force' => true,
    ]);

    // --------------------------------------------------
    // CACHE
    // --------------------------------------------------
    $this->call('borrarCache');

    $this->newLine();

    $this->info('🎉 Sistema reiniciado correctamente.');
})->purpose('Reinicia DB, seeders y cache');
