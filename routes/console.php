<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

Artisan::command('models', function () {
    $this->info('✨ Eliminando modelos antiguos en app/Models...');
    $modelsPath = app_path('Models');
    if (File::exists($modelsPath)) {
        $files = File::files($modelsPath);
        foreach ($files as $file) {
            File::delete($file);
        }
    }

    $this->info('✨ Aplicando migraciones desde cero...');
    Artisan::call('migrate:fresh');

    $this->info('✨ Generando modelos con Reliese...');
    Artisan::call('code:models');

    $this->info('✨ Agregando "use HasFactory;" a cada modelo...');
    $modelFiles = File::files($modelsPath);
    foreach ($modelFiles as $file) {
        $contents = File::get($file);

        if (!str_contains($contents, 'HasFactory')) {
            $contents = str_replace(
                'use Illuminate\Database\Eloquent\Model;',
                "use Illuminate\Database\Eloquent\Model;\nuse Illuminate\Database\Eloquent\Factories\HasFactory;",
                $contents
            );

            $contents = preg_replace_callback(
                '/class (\w+) extends Model\s*\{/',
                function ($matches) {
                    return $matches[0] . "\n    use HasFactory;";
                },
                $contents,
                1
            );
            File::put($file, $contents);
        }
    }
    $this->info('✅ Proceso finalizado exitosamente.');
})->purpose('Reinicia la base de datos, aplica migraciones, regenera modelos y agrega HasFactory.');

Artisan::command('borrarData', function () {
    $this->info('✨ Aplicando migraciones desde cero...');
    Artisan::call('migrate:fresh');

    $this->info('✅ Datos borrados exitosamente.');
})->purpose('Migraciones.');

Artisan::command('cargarData', function () {
    $this->info('✨ Cargando datos de prueba...');
    Artisan::call('db:seed');
    
    $this->info('✅ Datos cargados exitosamente.');
})->purpose('Seeders.');

Artisan::command('router', function () {
    $this->info("\n📌 Listado de rutas cargadas:\n");
    $this->call('route:list');
    
})->describe('Rputer.');