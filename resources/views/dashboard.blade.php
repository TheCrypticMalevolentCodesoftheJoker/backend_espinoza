@php
$dbConnected = false;
$dbMessage = 'No Conectado';
$dbClass = 'status-card-err';
$dbIcon = '✗';

try {
\Illuminate\Support\Facades\DB::connection()->getPdo();
$dbConnected = true;
$dbMessage = 'Conectado';
$dbClass = 'status-card-ok';
$dbIcon = '✓';
} catch (\Exception $e) {
$dbMessage = 'Error de Conexión';
}

$composerPath = base_path('composer.json');
$requires = [];
if (file_exists($composerPath)) {
$composerData = json_decode(file_get_contents($composerPath), true);
$requires = $composerData['require'] ?? [];
}

$libInfo = [
'php' => ['name' => 'PHP Runtime', 'desc' => 'Motor de ejecución del backend.', 'category' => 'Entorno'],
'laravel/framework' => ['name' => 'Laravel Framework', 'desc' => 'Estructura base del aplicativo MVC.', 'category' => 'Framework'],
'laravel/sanctum' => ['name' => 'Laravel Sanctum', 'desc' => 'Mecanismo de autenticación ligero de APIs y tokens.', 'category' => 'Seguridad'],
'laravel/tinker' => ['name' => 'Laravel Tinker', 'desc' => 'Shell REPL para interactuar con la app en tiempo real.', 'category' => 'Utilidad'],
'reliese/laravel' => ['name' => 'Reliese Laravel', 'desc' => 'Generación y modelado automático de esquemas de DB.', 'category' => 'BD']
];
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espinoza API</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&family=Nosifer&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <style>
        <?php echo file_exists(resource_path('css/dashboard.css')) ? file_get_contents(resource_path('css/dashboard.css')) : ''; ?>
    </style>
</head>

<body>
    <div class="app-layout">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('logo.webp') }}" alt="Logo" class="brand-logo">
                <div class="brand-details">
                    <span class="brand-name">Espinoza<span>API</span></span>
                </div>
            </div>

            <nav class="sidebar-menu">
                <a href="#overview" class="menu-item active" onclick="showSection('overview', this); return false;">
                    <svg class="menu-icon" viewBox="0 0 24 24">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                    </svg>
                    Vista General
                </a>
                <a href="#getting-started" class="menu-item" onclick="showSection('getting-started', this); return false;">
                    <svg class="menu-icon" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H7c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.04-.42 1.99-1.07 2.75z" />
                    </svg>
                    Guía de Inicio
                </a>
                <a href="#architecture" class="menu-item" onclick="showSection('architecture', this); return false;">
                    <svg class="menu-icon" viewBox="0 0 24 24">
                        <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H8V4h12v12z" />
                    </svg>
                    Arquitectura
                </a>
                <a href="https://github.com/TheCrypticMalevolentCodesoftheJoker/backend_espinoza" target="_blank" class="menu-item github-link">
                    <svg class="menu-icon" viewBox="0 0 24 24">
                        <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                    </svg>
                    Proyecto en Git
                </a>
            </nav>
        </aside>

        <main class="main-workspace">
            <header class="header">
                <div class="header-breadcrumb">
                    <span class="header-burger">☰</span>
                    <span class="crumb-active" id="crumb-title">Vista General</span>
                </div>
                <div class="header-actions">
                    <div class="status-indicator">
                        <span class="badge-env">Laravel {{ app()->version() }}</span>
                    </div>
                </div>
            </header>

            <div class="content-scrollable">
                <section id="sect-overview" class="tab-section active">
                    <div class="dashboard-hero">
                        <h1 class="hero-title">Backend API</h1>
                        <p class="hero-subtitle">Portal administrativo e informativo para el desarrollo del backend de Espinoza S.A.C.</p>
                    </div>

                    <div class="grid-layout cols-3">
                        <div class="info-card">
                            <div class="info-card-header">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-card-icon">
                                    <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                    <path d="M3 5V19A9 3 0 0 0 21 19V5"></path>
                                    <path d="M3 12A9 3 0 0 0 21 12"></path>
                                </svg>
                                <h3 class="info-card-title">Base de Datos</h3>
                            </div>
                            <p class="info-card-desc">{{ $dbMessage }} — {{ config('database.connections.mysql.database', 'espinoza_sac') }}@localhost</p>
                        </div>
                        <div class="info-card">
                            <div class="info-card-header">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-card-icon">
                                    <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                                    <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                                    <line x1="6" y1="6" x2="6.01" y2="6"></line>
                                    <line x1="6" y1="18" x2="6.01" y2="18"></line>
                                    <line x1="10" y1="6" x2="10.01" y2="6"></line>
                                    <line x1="10" y1="18" x2="10.01" y2="18"></line>
                                </svg>
                                <h3 class="info-card-title">Servidor Web</h3>
                            </div>
                            <p class="info-card-desc">{{ $_SERVER['HTTP_HOST'] ?? '127.0.0.1:8000' }} (Debug: {{ config('app.debug') ? 'ON' : 'OFF' }})</p>
                        </div>
                        <div class="info-card">
                            <div class="info-card-header">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-card-icon">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                                <h3 class="info-card-title">Seguridad API</h3>
                            </div>
                            <p class="info-card-desc">Sanctum Activo</p>
                        </div>
                    </div>

                    <div class="postman-horizon-card">
                        <div class="postman-content">
                            <h2 class="postman-title">Integración de Endpoints</h2>
                            <p class="postman-text">La colección oficial de endpoints para pruebas del backend de Espinoza se mantiene versionada en el repositorio. Utiliza este recurso para importar y ejecutar solicitudes HTTP en tu cliente de Postman local.</p>
                        </div>
                        <a href="https://github.com/TheCrypticMalevolentCodesoftheJoker/backend_espinoza/tree/main/postman" target="_blank" class="btn-icon-only" title="Ver Postman en Git">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                            </svg>
                        </a>
                    </div>

                    <div class="mt-10">
                        <h2 class="section-heading mb-20">Módulos Esenciales del Backend</h2>
                        <div class="modules-stack">
                            <div class="module-row-card">
                                <h4 class="module-title">Auth Module</h4>
                                <p class="module-desc">Gestión de autenticación de la plataforma, control de tokens JWT con Laravel Sanctum y procesos de registro, verificación y recuperación de accesos seguros.</p>
                            </div>

                            <div class="module-row-card">
                                <h4 class="module-title">User & Roles Module</h4>
                                <p class="module-desc">Control de cuentas de usuario, administración de perfiles y asignación jerárquica de roles y permisos del sistema para el control de accesos.</p>
                            </div>

                            <div class="module-row-card">
                                <h4 class="module-title">Catalog</h4>
                                <p class="module-desc">Módulo central del catálogo comercial. Encapsula y gestiona la lógica de tres sub-módulos clave:</p>
                                <div class="sub-modules-badges">
                                    <span class="sub-badge">Marcas</span>
                                    <span class="sub-badge">Categorías</span>
                                    <span class="sub-badge">Productos</span>
                                </div>
                            </div>

                            <div class="module-row-card">
                                <h4 class="module-title">Analytics Engine</h4>
                                <p class="module-desc">Procesamiento de estadísticas del catálogo, reportes de actividad, agregadores de métricas comerciales y tableros informativos.</p>
                            </div>

                            <div class="module-row-card">
                                <h4 class="module-title">Shared Kernel</h4>
                                <p class="module-desc">Módulo transversal con componentes compartidos: formateadores estándar de respuestas JSON de la API, middleware global de cabeceras, registro de logs y gestores unificados de excepciones.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="sect-getting-started" class="tab-section">
                    <h2 class="content-title">Guía de Inicio</h2>
                    <p class="content-p">Instrucciones básicas para configurar tu entorno de desarrollo local. Copia los comandos individualmente para ejecutarlos en tu consola.</p>

                    <div class="grid-layout gap-16">
                        <div class="doc-card">
                            <h3>1. Clonar el repositorio</h3>
                            <p class="mb-12">Descarga la última versión del backend de Espinoza a tu entorno local.</p>
                            <div class="command-line">
                                <code id="cmd-1-a">git clone https://github.com/TheCrypticMalevolentCodesoftheJoker/backend_espinoza.git</code>
                                <button class="copy-inline-btn" onclick="copyText('cmd-1-a', this)">Copiar</button>
                            </div>
                            <div class="command-line">
                                <code id="cmd-1-b">cd backend_espinoza</code>
                                <button class="copy-inline-btn" onclick="copyText('cmd-1-b', this)">Copiar</button>
                            </div>
                        </div>

                        <div class="doc-card">
                            <h3>2. Instalar dependencias de PHP</h3>
                            <p class="mb-12">Descarga e instala los paquetes de terceros definidos en composer.json.</p>
                            <div class="command-line">
                                <code id="cmd-2">composer install</code>
                                <button class="copy-inline-btn" onclick="copyText('cmd-2', this)">Copiar</button>
                            </div>
                        </div>

                        <div class="doc-card">
                            <h3>3. Configuración del archivo de entorno (.env)</h3>
                            <p class="mb-12">Crea el archivo .env de configuración local y genera la llave del sistema.</p>
                            <div class="command-line">
                                <code id="cmd-3-a">cp .env.example .env</code>
                                <button class="copy-inline-btn" onclick="copyText('cmd-3-a', this)">Copiar</button>
                            </div>
                            <div class="command-line">
                                <code id="cmd-3-b">php artisan key:generate</code>
                                <button class="copy-inline-btn" onclick="copyText('cmd-3-b', this)">Copiar</button>
                            </div>

                            <p class="env-help-text">Posteriormente, agrega las siguientes variables de configuración en tu archivo <code>.env</code> (completa los campos marcados con <code>?</code> con tus credenciales locales):</p>
                            <div class="code-container mt-10">
                                <pre><code id="env-values"># --------------------------------------------------------------------------
# Configuración de app.php
# --------------------------------------------------------------------------
APP_NAME="Espiniza S.A.C."
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
APP_TIMEZONE=America/Lima

APP_LOCALE=es
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_PE

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=maintenance

# --------------------------------------------------------------------------
# Configuración de database.php
# --------------------------------------------------------------------------
DB_CONNECTION=mysql

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=espinoza_sac
DB_USERNAME=?
DB_PASSWORD=?</code></pre>
                                <button class="copy-cmd-btn" onclick="copyText('env-values', this)">Copiar</button>
                            </div>
                        </div>

                        <div class="doc-card">
                            <h3>4. Levantar servidor local</h3>
                            <p class="mb-12">Inicia el servidor Artisan para servir el backend en tu entorno local.</p>
                            <div class="command-line">
                                <code id="cmd-4">php artisan serve</code>
                                <button class="copy-inline-btn" onclick="copyText('cmd-4', this)">Copiar</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="sect-architecture" class="tab-section">
                    <h2 class="content-title">Arquitectura del Sistema</h2>
                    <p class="content-p">El desarrollo del backend de Espinoza sigue principios sólidos de ingeniería de software para asegurar escalabilidad y mantenibilidad.</p>

                    <div class="info-card mb-24">
                        <h3 class="section-heading">Arquitectura Modular & Shared Kernel</h3>
                        <p class="card-para mb-12">En lugar de la estructura tradicional plana de MVC, este sistema implementa una <strong>arquitectura modular estructurada en dominios</strong>:</p>
                        <ul class="architecture-list">
                            <li><strong>app/Modules:</strong> Contiene dominios autocontenidos y aislados (Auth, Catalog, Role, User, Analytics). Cada módulo encapsula sus propios controladores, modelos, validaciones (Requests) y clases de servicio/acciones.</li>
                            <li><strong>app/Shared:</strong> Componentes comunes y utilidades generales de soporte (formateadores genéricos de respuestas API JSON, middlewares globales y manejador unificado de excepciones).</li>
                        </ul>
                    </div>

                    <div class="info-card mb-24">
                        <h3 class="section-heading">Principios de Diseño & Patrones</h3>
                        <div class="grid-layout cols-3 pattern-grid">
                            <div class="pattern-card">
                                <h4>SOLID Principles</h4>
                                <p><strong>Responsabilidad Única</strong> en controladores, encapsulación de dependencias y segregación de contratos en interfaces para desacoplar las capas lógicas.</p>
                            </div>
                            <div class="pattern-card">
                                <h4>Clean Code</h4>
                                <p>Código semántico y auto-explicativo. Separación estricta de la validación del request mediante Form Requests dedicados, manteniendo los controladores limpios.</p>
                            </div>
                            <div class="pattern-card">
                                <h4>Domain-Driven Design (DDD)</h4>
                                <p>Organización en torno a conceptos y límites lógicos de negocio (Bounded Contexts) en vez de agrupaciones puramente técnicas.</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3 class="section-heading">Tecnologías y Librerías Utilizadas</h3>
                        <table class="val-table">
                            <thead>
                                <tr>
                                    <th>Tecnología / Dependencia</th>
                                    <th>Versión Requerida</th>
                                    <th>Categoría</th>
                                    <th>Propósito del Paquete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requires as $libName => $libVer)
                                @php
                                $map = $libInfo[$libName] ?? ['name' => $libName, 'desc' => 'Librería auxiliar del backend.', 'category' => 'Paquete'];
                                @endphp
                                <tr>
                                    <td><strong>{{ $map['name'] }}</strong> <code class="table-lib-name">{{ $libName }}</code></td>
                                    <td><code>{{ $libVer }}</code></td>
                                    <td><span class="sub-badge table-category-badge">{{ $map['category'] }}</span></td>
                                    <td class="table-lib-desc">{{ $map['desc'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <footer class="footer">
                    <p>© 2026 Espinoza API. Diseñado bajo estándares profesionales de desarrollo de software.</p>
                </footer>
            </div>
        </main>
    </div>

    <div id="toast" class="toast-notification">
        <span>✓</span>
        <span id="toast-message">Copiado al portapapeles</span>
    </div>

    <script>
        function showSection(sectId, element) {
            document.querySelectorAll('.menu-item').forEach(el => el.classList.remove('active'));
            if (element) element.classList.add('active');

            document.querySelectorAll('.tab-section').forEach(el => el.classList.remove('active'));
            document.getElementById('sect-' + sectId).classList.add('active');

            const titles = {
                'overview': 'Vista General',
                'getting-started': 'Guía de Inicio',
                'architecture': 'Arquitectura'
            };
            document.getElementById('crumb-title').textContent = titles[sectId] || 'Panel';
        }

        function copyText(elementId, btn) {
            const el = document.getElementById(elementId);
            if (!el) return;

            const textToCopy = el.textContent;
            navigator.clipboard.writeText(textToCopy).then(() => {
                showToast('¡Copiado!');

                const originalText = btn.textContent;
                btn.textContent = '¡Copiado!';
                btn.classList.add('copied');
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.classList.remove('copied');
                }, 1500);
            }).catch(err => {
                console.error('Error al copiar texto: ', err);
            });
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toast-message');
            toastMsg.textContent = message;

            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }
    </script>
</body>

</html>