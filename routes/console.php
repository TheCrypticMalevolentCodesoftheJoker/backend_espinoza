<?php

use Illuminate\Support\Facades\Artisan;

// ======================================================
// CACHE / OPTIMIZE
// ======================================================
Artisan::command('borrarCache', function () {

    $this->newLine();
    $this->info('🚀 Iniciando optimización del sistema...');

    //----------------------------------------------------------------------
    // Limpieza de cachés y archivos optimizados
    //----------------------------------------------------------------------
    $this->info('🧹 Limpiando caches antiguas...');

    try {

        $this->call('optimize:clear');
    } catch (Throwable $e) {

        $this->error('❌ Error durante optimize:clear');
        $this->line($e->getMessage());

        return;
    }

    //----------------------------------------------------------------------
    // Generación de caché de configuración
    //----------------------------------------------------------------------
    $this->info('⚙ Generando config cache...');

    try {

        $this->call('config:cache');
    } catch (Throwable $e) {

        $this->warn('⚠ Error al generar config cache');
        $this->line($e->getMessage());
    }

    //----------------------------------------------------------------------
    // Generación de caché de rutas
    //----------------------------------------------------------------------
    $this->info('🛣 Generando route cache...');

    try {

        $this->call('route:cache');
    } catch (Throwable $e) {

        $this->warn('⚠ Error al generar route cache');
        $this->line($e->getMessage());
    }

    //----------------------------------------------------------------------
    // Generación de caché de vistas Blade
    //----------------------------------------------------------------------
    $this->info('🖼 Generando view cache...');

    try {

        $this->call('view:cache');
    } catch (Throwable $e) {

        $this->warn('⚠ Error al generar view cache');
        $this->line($e->getMessage());
    }

    //----------------------------------------------------------------------
    // Generación de caché de eventos
    //----------------------------------------------------------------------
    $this->info('📦 Generando event cache...');

    try {

        $this->call('event:cache');
    } catch (Throwable $e) {

        $this->warn('⚠ Error al generar event cache');
        $this->line($e->getMessage());
    }

    //----------------------------------------------------------------------
    // Descubrimiento de paquetes
    //----------------------------------------------------------------------
    $this->info('🔍 Descubriendo paquetes...');

    try {

        $this->call('package:discover');
    } catch (Throwable $e) {

        $this->warn('⚠ Error durante package discovery');
        $this->line($e->getMessage());
    }

    //----------------------------------------------------------------------
    // Resumen final
    //----------------------------------------------------------------------
    $this->newLine();

    $this->warn('👉 Ejecuta si es necesario:');
    $this->line('composer dump-autoload -o');

    if (app()->isProduction()) {

        $this->info('🌎 Entorno PRODUCCIÓN');
    } else {

        $this->info('🖥 Entorno LOCAL');
    }

    $this->info('✅ Sistema optimizado correctamente.');
})->purpose('Optimiza y reconstruye los componentes cacheados de la aplicación');

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
Artisan::command('rebuild', function () {

    $this->newLine();

    if (app()->isProduction()) {

        $this->error('❌ No permitido en producción.');
        return;
    }

    $this->info('🚀 Iniciando reconstrucción completa del sistema...');

    // --------------------------------------------------
    // MIGRATIONS
    // --------------------------------------------------
    $this->info('⚙ Creando tablas desde cero (migrate:fresh)...');
    $this->call('migrate:fresh', [
        '--force' => true,
    ]);

    // --------------------------------------------------
    // SEEDERS
    // --------------------------------------------------
    $this->info('🌱 Alimentando la base de datos (db:seed)...');
    $this->call('db:seed', [
        '--force' => true,
    ]);

    // --------------------------------------------------
    // MODELS GENERATION
    // --------------------------------------------------
    $this->info('🤖 Generando modelos de Eloquent (code:models)...');
    $this->call('code:models');

    // --------------------------------------------------
    // CACHE
    // --------------------------------------------------
    $this->call('borrarCache');

    $this->newLine();

    $this->info('🎉 Sistema reconstruido y modelos actualizados con éxito.');
})->purpose('Reconstruye base de datos, ejecuta seeders, autogenera modelos y limpia caches');
