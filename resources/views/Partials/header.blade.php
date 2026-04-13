<header class="app-header">
    <section class="app-header__left">
        <h1 class="app-header__title">
            @yield('header_title', 'Espinoza S.A.C.')
        </h1>
    </section>
    <section class="app-header__right">
        <button class="app-header__notification" title="Notificaciones">
             <i data-lucide="bell"></i>
        </button>
        <button class="app-header__user" title="Nombre del usuario">
             <i data-lucide="user"></i>
        </button>
        <button class="app-header__logout" title="Cerrar sesión">
             <i data-lucide="log-out"></i>
        </button>
    </section>
</header>