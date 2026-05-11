<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\File;

class EscanearArquitectura extends Command
{
    protected $signature = 'sistema:EscanearArquitectura
                            {path?}
                            {--LimpiarArquitectura}';
    protected $description = '📦 Genera un archivo de la arquitectura del proyecto';

    protected $outputContent = "";

    public function handle()
    {
        $outputDir = resource_path('ArquitecturaProyecto');

        // 1️⃣ Lógica para limpiar
        if ($this->option('LimpiarArquitectura')) {
            if (File::exists($outputDir)) {
                File::cleanDirectory($outputDir);
                $this->info("✨ Todos los archivos dentro de la carpeta ArquitecturaProyecto se eliminaron exitosamente.");
            } else {
                $this->info("📂 La carpeta ArquitecturaProyecto no existe. No hay archivos que limpiar.");
            }
            return;
        }

        // 2️⃣ Crear carpeta si no existe
        if (!File::exists($outputDir)) {
            File::makeDirectory($outputDir, 0755, true);
        }

        $argument = $this->argument('path') ?? 'all';
        $fecha = now()->format('d-m-Y_H-i');

        $this->outputContent = "# Estructura del Proyecto Laravel\n\n";

        // 3️⃣ Escanear toda la arquitectura o carpeta específica
        if ($argument === 'all') {
            $fileName = "General{$fecha}.md";
            $this->info("✨ Escaneando toda la arquitectura del proyecto...");
            $carpetas = ['app','bootstrap','config','database','public','resources','routes','storage','tests'];

            foreach ($carpetas as $carpeta) {
                $ruta = base_path($carpeta);
                if (is_dir($ruta)) {
                    $this->appendOutput("📁 {$carpeta}/");
                    $this->mapDirectory($ruta, '');
                }
            }
        } else {
            $fileName = "{$argument}_{$fecha}.md";
            $basePath = base_path($argument);
            if (!is_dir($basePath)) {
                $this->error("❌ La carpeta {$basePath} no existe.");
                return;
            }

            $this->info("✨ Escaneando: {$basePath}");
            $this->appendOutput("📁 {$argument}/");
            $this->mapDirectory($basePath);
        }

        // Generar el archivo con el nombre correcto
        $outputPath = $outputDir . DIRECTORY_SEPARATOR . $fileName;
        file_put_contents($outputPath, $this->outputContent);
        $this->info("✅ Archivo {$fileName} generado exitosamente en resources/ArquitecturaProyecto.");
    }

    protected function mapDirectory($dir, $indent = '')
    {
        $finder = new Finder();
        $finder->in($dir)->depth(0)->sortByName();

        foreach ($finder as $file) {
            if ($file->isDir()) {
                $line = "{$indent}├── 📂 " . $file->getFilename();
                $this->appendOutput($line);
                $this->mapDirectory($file->getRealPath(), $indent . "│   ");
            } else {
                $line = "{$indent}│   📄 " . $file->getFilename();
                $this->appendOutput($line);
            }
        }
    }

    protected function appendOutput($line)
    {
        $this->outputContent .= $line . "\n";
    }
}