<?php
$jsonPath = base_path('postman/Espinoza.postman_collection.json');
$endpoints = [];
$folders = [];

if (file_exists($jsonPath)) {
$collection = json_decode(file_get_contents($jsonPath), true);

$parseItems = function ($items, $folderName = '') use (&$parseItems, &$endpoints, &$folders) {
foreach ($items as $item) {
if (isset($item['item'])) {
// It's a folder/subfolder
$currentFolder = $folderName ? $folderName . '/' . $item['name'] : $item['name'];
$parseItems($item['item'], $currentFolder);
} else {
// It's a request
$req = $item['request'] ?? [];
$method = $req['method'] ?? 'GET';

// Get raw URL
$url = '';
if (isset($req['url'])) {
if (is_array($req['url'])) {
$url = $req['url']['raw'] ?? '';
} else {
$url = $req['url'];
}
}

// Headers
$headers = [];
if (isset($req['header'])) {
foreach ($req['header'] as $h) {
if (!empty($h['key']) && !($h['disabled'] ?? false)) {
$headers[] = [
'key' => $h['key'],
'value' => $h['value'] ?? '',
'description' => $h['description'] ?? '',
];
}
}
}

// Payload/Body
$payload = null;
if (isset($req['body']) && ($req['body']['mode'] ?? '') === 'raw') {
$rawBody = $req['body']['raw'] ?? '';
$decoded = json_decode($rawBody, true);
if (json_last_error() === JSON_ERROR_NONE) {
$payload = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} else {
$payload = $rawBody;
}
}

$fName = $folderName ?: 'Root';
$endpoints[] = [
'id' => uniqid('ep_'),
'name' => $item['name'] ?? 'Unnamed Request',
'folder' => $fName,
'method' => strtoupper($method),
'url' => $url,
'headers' => $headers,
'payload' => $payload,
];

if (!in_array($fName, $folders)) {
$folders[] = $fName;
}
}
}
};

if (isset($collection['item']) && is_array($collection['item'])) {
$parseItems($collection['item']);
}
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espinoza API Hub - Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Embed CSS directly from resources/css/dashboard.css to keep routing untouched -->
    <style>
        <?php echo file_exists(resource_path('css/dashboard.css')) ? file_get_contents(resource_path('css/dashboard.css')) : ''; ?>
    </style>
</head>

<body>
    <!-- Main Dashboard Layout -->
    <div class="app-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-area">
                    <span class="logo-icon">⚡</span>
                    <span class="logo-text">Espinoza<span>API</span></span>
                </div>
                <div class="badge-status">
                    <span class="status-dot"></span>
                    <span class="status-text">v1.0.0</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section-title">Carpetas / Módulos</div>
                <ul class="folder-list">
                    <li class="folder-item active" data-folder="all">
                        <span class="folder-icon">📂</span>
                        <span class="folder-name">Todos los Endpoints</span>
                        <span class="folder-badge total-badge"><?php echo e(count($endpoints)); ?></span>
                    </li>
                    <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $folderCount = collect($endpoints)->where('folder', $folder)->count();
                    ?>
                    <li class="folder-item" data-folder="<?php echo e($folder); ?>">
                        <span class="folder-icon">📁</span>
                        <span class="folder-name"><?php echo e($folder); ?></span>
                        <span class="folder-badge"><?php echo e($folderCount); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <header class="content-header">
                <div class="header-titles">
                    <h1>Documentación interactiva de la API</h1>
                    <p>Explora, copia payloads y genera peticiones en un solo clic.</p>
                </div>
                <!-- Stat Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <span class="stat-label">Total</span>
                        <span class="stat-value"><?php echo e(count($endpoints)); ?></span>
                    </div>
                    <div class="stat-card stat-get">
                        <span class="stat-label">GET</span>
                        <span class="stat-value"><?php echo e(collect($endpoints)->where('method', 'GET')->count()); ?></span>
                    </div>
                    <div class="stat-card stat-post">
                        <span class="stat-label">POST</span>
                        <span class="stat-value"><?php echo e(collect($endpoints)->where('method', 'POST')->count()); ?></span>
                    </div>
                    <div class="stat-card stat-other">
                        <span class="stat-label">Otros</span>
                        <span class="stat-value"><?php echo e(collect($endpoints)->whereNotIn('method', ['GET', 'POST'])->count()); ?></span>
                    </div>
                </div>
            </header>

            <!-- Search & Filters Container -->
            <section class="filters-bar">
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="search-input" placeholder="Buscar por nombre, ruta o método..." autocomplete="off">
                    <button id="clear-search" class="clear-search-btn" style="display: none;">&times;</button>
                </div>

                <div class="method-filters">
                    <button class="filter-method-btn active" data-method="ALL">ALL</button>
                    <button class="filter-method-btn method-get" data-method="GET">GET</button>
                    <button class="filter-method-btn method-post" data-method="POST">POST</button>
                    <button class="filter-method-btn method-put" data-method="PUT">PUT</button>
                    <button class="filter-method-btn method-patch" data-method="PATCH">PATCH</button>
                    <button class="filter-method-btn method-delete" data-method="DELETE">DELETE</button>
                </div>
            </section>

            <!-- Endpoints Container -->
            <section class="endpoints-list-container">
                <div class="no-results" id="no-results" style="display: none;">
                    <div class="no-results-icon">🔍</div>
                    <h3>No se encontraron endpoints</h3>
                    <p>Intenta ajustar tu búsqueda o filtros.</p>
                </div>

                <div class="endpoints-list" id="endpoints-list">
                    <?php $__empty_1 = true; $__currentLoopData = $endpoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $endpoint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <article class="endpoint-card"
                        id="<?php echo e($endpoint['id']); ?>"
                        data-folder="<?php echo e($endpoint['folder']); ?>"
                        data-method="<?php echo e($endpoint['method']); ?>"
                        data-name="<?php echo e(strtolower($endpoint['name'])); ?>"
                        data-url="<?php echo e(strtolower($endpoint['url'])); ?>"
                        data-headers="<?php echo e(e(json_encode($endpoint['headers']))); ?>"
                        data-payload="<?php echo e(e($endpoint['payload'])); ?>">

                        <!-- Card Header (Always Visible) -->
                        <header class="endpoint-card-header" onclick="toggleCard('<?php echo e($endpoint['id']); ?>')">
                            <div class="header-left">
                                <span class="method-badge method-<?php echo e(strtolower($endpoint['method'])); ?>"><?php echo e($endpoint['method']); ?></span>
                                <div class="endpoint-info">
                                    <h3 class="endpoint-name"><?php echo e($endpoint['name']); ?></h3>
                                    <code class="endpoint-url-text"><?php echo e($endpoint['url']); ?></code>
                                </div>
                            </div>
                            <div class="header-right" onclick="event.stopPropagation();">
                                <button class="action-icon-btn copy-url-btn" onclick="copyUrl('<?php echo e($endpoint['url']); ?>', this)" title="Copiar endpoint">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                </button>
                                <button class="action-icon-btn toggle-arrow" onclick="toggleCard('<?php echo e($endpoint['id']); ?>')" title="Expandir/Colapsar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                            </div>
                        </header>

                        <!-- Card Body (Collapsible) -->
                        <div class="endpoint-card-body-wrapper" style="height: 0px;">
                            <div class="endpoint-card-body">

                                <!-- Endpoint Meta Block (Headers / Details) -->
                                <?php if(count($endpoint['headers']) > 0): ?>
                                <div class="meta-section">
                                    <h4 class="section-title">Headers requeridos</h4>
                                    <div class="headers-table-wrapper">
                                        <table class="headers-table">
                                            <thead>
                                                <tr>
                                                    <th>Header</th>
                                                    <th>Valor</th>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $endpoint['headers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><code><?php echo e($header['key']); ?></code></td>
                                                    <td><code class="header-val-truncate" title="<?php echo e($header['value']); ?>"><?php echo e($header['value']); ?></code></td>
                                                    <td class="header-desc"><?php echo e($header['description'] ?: 'Sin descripción'); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Interactive Tabs System -->
                                <div class="tabs-container">
                                    <div class="tabs-header">
                                        <div class="tabs-list">
                                            <?php if($endpoint['payload']): ?>
                                            <button class="tab-btn active" onclick="switchTab(this, 'payload')">Payload</button>
                                            <?php endif; ?>
                                            <button class="tab-btn <?php echo e(!$endpoint['payload'] ? 'active' : ''); ?>" onclick="switchTab(this, 'axios')">Axios</button>
                                            <button class="tab-btn" onclick="switchTab(this, 'fetch')">Fetch API</button>
                                        </div>
                                        <button class="copy-code-btn" onclick="copyActiveCode('<?php echo e($endpoint['id']); ?>', this)">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                            </svg>
                                            <span>Copiar código</span>
                                        </button>
                                    </div>

                                    <div class="tabs-content">
                                        <?php if($endpoint['payload']): ?>
                                        <div class="tab-panel active" data-tab="payload">
                                            <pre><code class="language-json"><?php echo e($endpoint['payload']); ?></code></pre>
                                        </div>
                                        <?php endif; ?>

                                        <div class="tab-panel <?php echo e(!$endpoint['payload'] ? 'active' : ''); ?>" data-tab="axios">
                                            <pre><code class="language-javascript loading-snippet">Cargando Axios snippet...</code></pre>
                                        </div>

                                        <div class="tab-panel" data-tab="fetch">
                                            <pre><code class="language-javascript loading-snippet">Cargando Fetch snippet...</code></pre>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="no-results">
                        <div class="no-results-icon">📂</div>
                        <h3>No hay endpoints disponibles</h3>
                        <p>El archivo de colección de Postman parece estar vacío o no se ha encontrado.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
        </main>
    </div>

    <!-- Notification Toast System -->
    <div id="toast" class="toast-notification">
        <span class="toast-icon">✨</span>
        <span id="toast-message" class="toast-message">Copiado al portapapeles</span>
    </div>

    <!-- JavaScript Logic -->
    <script>
        // Store endpoints DOM elements and details for rapid filtering
        const searchInput = document.getElementById('search-input');
        const clearSearchBtn = document.getElementById('clear-search');
        const folderItems = document.querySelectorAll('.folder-item');
        const methodFilters = document.querySelectorAll('.filter-method-btn');
        const cards = document.querySelectorAll('.endpoint-card');
        const noResults = document.getElementById('no-results');

        let activeFolder = 'all';
        let activeMethod = 'ALL';

        // -------------------------------------------------------------
        // Search & Filtering Logic
        // -------------------------------------------------------------
        function applyFilters() {
            const query = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            cards.forEach(card => {
                const folder = card.getAttribute('data-folder');
                const method = card.getAttribute('data-method');
                const name = card.getAttribute('data-name');
                const url = card.getAttribute('data-url');

                // Check folder filter
                const folderMatch = (activeFolder === 'all' || folder === activeFolder);
                // Check method filter
                const methodMatch = (activeMethod === 'ALL' || method === activeMethod);
                // Check search text query (name or url)
                const searchMatch = !query || name.includes(query) || url.includes(query) || method.toLowerCase().includes(query);

                if (folderMatch && methodMatch && searchMatch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                    // If it was open, close it to maintain cleanliness
                    closeCard(card.id);
                }
            });

            if (visibleCount === 0 && cards.length > 0) {
                noResults.style.display = 'flex';
            } else {
                noResults.style.display = 'none';
            }
        }

        // Search Input listeners
        searchInput.addEventListener('input', () => {
            if (searchInput.value.length > 0) {
                clearSearchBtn.style.display = 'block';
            } else {
                clearSearchBtn.style.display = 'none';
            }
            applyFilters();
        });

        clearSearchBtn.addEventListener('click', () => {
            searchInput.value = '';
            clearSearchBtn.style.display = 'none';
            searchInput.focus();
            applyFilters();
        });

        // Folder sidebar filters
        folderItems.forEach(item => {
            item.addEventListener('click', () => {
                folderItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                activeFolder = item.getAttribute('data-folder');
                applyFilters();
            });
        });

        // Method filters
        methodFilters.forEach(btn => {
            btn.addEventListener('click', () => {
                methodFilters.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeMethod = btn.getAttribute('data-method');
                applyFilters();
            });
        });

        // -------------------------------------------------------------
        // Dynamic Code Generation (Axios & Fetch)
        // -------------------------------------------------------------
        function generateAxiosCode(method, url, headers, payload) {
            let code = `// Usando Axios\n`;
            code += `axios({\n`;
            code += `  method: '${method.toLowerCase()}',\n`;
            code += `  url: '${url}',`;

            // Build headers block
            const headerObj = {};
            if (headers && headers.length > 0) {
                headers.forEach(h => {
                    headerObj[h.key] = h.value;
                });
            }
            if (payload && ['POST', 'PUT', 'PATCH', 'DELETE'].includes(method)) {
                headerObj['Content-Type'] = 'application/json';
            }

            if (Object.keys(headerObj).length > 0) {
                code += `\n  headers: {\n`;
                const keys = Object.keys(headerObj);
                keys.forEach((key, index) => {
                    code += `    '${key}': '${headerObj[key]}'${index < keys.length - 1 ? ',' : ''}\n`;
                });
                code += `  },`;
            }

            // Build body data block
            if (payload && ['POST', 'PUT', 'PATCH', 'DELETE'].includes(method)) {
                try {
                    // Try parsing to format or keep as pretty string
                    const indented = payload.split('\n').map(line => '  ' + line).join('\n');
                    code += `\n  data: ${indented.trim()}`;
                } catch (e) {
                    code += `\n  data: ${JSON.stringify(payload)}`;
                }
            }

            code += `\n})\n.then(response => {\n  console.log('Success:', response.data);\n})\n.catch(error => {\n  console.error('Error:', error.response ? error.response.data : error.message);\n});`;
            return code;
        }

        function generateFetchCode(method, url, headers, payload) {
            let code = `// Usando Fetch API\n`;

            const headerObj = {};
            if (headers && headers.length > 0) {
                headers.forEach(h => {
                    headerObj[h.key] = h.value;
                });
            }
            if (payload && ['POST', 'PUT', 'PATCH', 'DELETE'].includes(method)) {
                headerObj['Content-Type'] = 'application/json';
            }

            code += `fetch('${url}', {\n`;
            code += `  method: '${method}',`;

            if (Object.keys(headerObj).length > 0) {
                code += `\n  headers: {\n`;
                const keys = Object.keys(headerObj);
                keys.forEach((key, index) => {
                    code += `    '${key}': '${headerObj[key]}'${index < keys.length - 1 ? ',' : ''}\n`;
                });
                code += `  },`;
            }

            if (payload && ['POST', 'PUT', 'PATCH', 'DELETE'].includes(method)) {
                try {
                    const indented = payload.split('\n').map(line => '    ' + line).join('\n');
                    code += `\n  body: JSON.stringify(${indented.trim()})`;
                } catch (e) {
                    code += `\n  body: JSON.stringify(${payload})`;
                }
            }

            code += `\n})\n.then(response => {\n  if (!response.ok) throw new Error('HTTP status ' + response.status);\n  return response.json();\n})\n.then(data => {\n  console.log('Success:', data);\n})\n.catch(error => {\n  console.error('Error:', error);\n});`;
            return code;
        }

        // Initialize code snippets inside cards when they are opened
        function initializeCodeSnippets(card) {
            const method = card.getAttribute('data-method');
            const url = card.querySelector('.endpoint-url-text').textContent;

            let headers = [];
            try {
                headers = JSON.parse(card.getAttribute('data-headers') || '[]');
            } catch (e) {
                console.error("Error parsing headers attribute", e);
            }

            const payload = card.getAttribute('data-payload') || null;

            // Generate and place code in Axios panel
            const axiosPanel = card.querySelector('.tab-panel[data-tab="axios"] code');
            if (axiosPanel && axiosPanel.classList.contains('loading-snippet')) {
                axiosPanel.textContent = generateAxiosCode(method, url, headers, payload);
                axiosPanel.classList.remove('loading-snippet');
            }

            // Generate and place code in Fetch panel
            const fetchPanel = card.querySelector('.tab-panel[data-tab="fetch"] code');
            if (fetchPanel && fetchPanel.classList.contains('loading-snippet')) {
                fetchPanel.textContent = generateFetchCode(method, url, headers, payload);
                fetchPanel.classList.remove('loading-snippet');
            }
        }

        // -------------------------------------------------------------
        // Accordion (Expand / Collapse) Actions
        // -------------------------------------------------------------
        function toggleCard(cardId) {
            const card = document.getElementById(cardId);
            const wrapper = card.querySelector('.endpoint-card-body-wrapper');
            const inner = card.querySelector('.endpoint-card-body');
            const arrow = card.querySelector('.toggle-arrow');

            if (card.classList.contains('open')) {
                // Close
                wrapper.style.height = '0px';
                card.classList.remove('open');
                arrow.classList.remove('rotated');
            } else {
                // Initialize snippets first if loading
                initializeCodeSnippets(card);

                // Open
                const height = inner.scrollHeight;
                wrapper.style.height = height + 'px';
                card.classList.add('open');
                arrow.classList.add('rotated');

                // Adjust height after transition completes in case size of tabs change
                setTimeout(() => {
                    if (card.classList.contains('open')) {
                        wrapper.style.height = 'auto';
                    }
                }, 300);
            }
        }

        function closeCard(cardId) {
            const card = document.getElementById(cardId);
            const wrapper = card.querySelector('.endpoint-card-body-wrapper');
            const arrow = card.querySelector('.toggle-arrow');

            if (card.classList.contains('open')) {
                // Get current physical height before setting it to allow transition
                const currentHeight = wrapper.scrollHeight;
                wrapper.style.height = currentHeight + 'px';

                // Force layout reflow
                wrapper.offsetHeight;

                wrapper.style.height = '0px';
                card.classList.remove('open');
                arrow.classList.remove('rotated');
            }
        }

        // -------------------------------------------------------------
        // Tab switching
        // -------------------------------------------------------------
        function switchTab(btn, tabName) {
            const container = btn.closest('.tabs-container');
            const buttons = container.querySelectorAll('.tab-btn');
            const panels = container.querySelectorAll('.tab-panel');
            const bodyWrapper = btn.closest('.endpoint-card-body-wrapper');

            // Set active buttons
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Set active panel
            panels.forEach(p => {
                if (p.getAttribute('data-tab') === tabName) {
                    p.classList.add('active');
                } else {
                    p.classList.remove('active');
                }
            });

            // Adjust physical wrapper height if it was set to a manual pixel size
            if (bodyWrapper.style.height !== 'auto' && bodyWrapper.style.height !== '0px') {
                const inner = btn.closest('.endpoint-card-body');
                bodyWrapper.style.height = inner.scrollHeight + 'px';
            }
        }

        // -------------------------------------------------------------
        // Clipboard & Toast Systems
        // -------------------------------------------------------------
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        let toastTimeout = null;

        function showToast(message) {
            toastMessage.textContent = message;
            toast.classList.add('show');

            if (toastTimeout) {
                clearTimeout(toastTimeout);
            }

            toastTimeout = setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }

        // Fix copy to clipboard functionality by falling back if navigator.clipboard is unavailable
        function fallbackCopyText(text, successCallback) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed"; // Avoid scrolling to bottom
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                const successful = document.execCommand('copy');
                if (successful) successCallback();
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }
            document.body.removeChild(textArea);
        }

        function copyTextToClipboard(text, successCallback) {
            if (!navigator.clipboard) {
                fallbackCopyText(text, successCallback);
                return;
            }
            navigator.clipboard.writeText(text).then(successCallback).catch(err => {
                console.error('Async: Could not copy text: ', err);
                fallbackCopyText(text, successCallback);
            });
        }

        function copyUrl(url, btn) {
            copyTextToClipboard(url, () => {
                showToast('¡URL del Endpoint copiada!');

                // Visual feedback micro-animation on button
                btn.classList.add('copied');
                setTimeout(() => btn.classList.remove('copied'), 1000);
            });
        }

        function copyActiveCode(cardId, btn) {
            const card = document.getElementById(cardId);
            const activePanel = card.querySelector('.tab-panel.active code');

            if (!activePanel) return;

            const codeToCopy = activePanel.textContent;

            copyTextToClipboard(codeToCopy, () => {
                const activeTabBtn = card.querySelector('.tab-btn.active');
                const tabName = activeTabBtn ? activeTabBtn.textContent : 'Código';
                showToast(`¡${tabName} copiado al portapapeles!`);

                // Button visual feedback
                const btnText = btn.querySelector('span');
                const originalText = btnText.textContent;
                btnText.textContent = '¡Copiado!';
                btn.classList.add('copied-btn');

                setTimeout(() => {
                    btnText.textContent = originalText;
                    btn.classList.remove('copied-btn');
                }, 1500);
            });
        }
    </script>
</body>

</html><?php /**PATH D:\Proyectos\Espinoza\backend\resources\views\dashboard.blade.php ENDPATH**/ ?>