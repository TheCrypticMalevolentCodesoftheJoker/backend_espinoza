<aside class="panel-sidebar">
    <div class="panel-sidebar__brand">
        <div class="panel-sidebar__logo-icon">
            <i data-lucide="layers"></i>
        </div>
        <div class="panel-sidebar__brand-text">
            <h1>ESPINOZA S.A.C.</h1>
        </div>
    </div>

    <div class="panel-sidebar__body">

        <section class="panel-sidebar__group">
            <h2 class="panel-sidebar__heading">General</h2>
            <ul class="panel-sidebar__menu">
                <li class="panel-sidebar__item">
                    <a class="btn-surface-info" href="{{ route('dashboard') }}">
                        <i class="btn-surface__icon" data-lucide="home"></i>
                        <span class="btn-surface__text">Dashboard</span>
                    </a>
                </li>
            </ul>
        </section>

        <section class="panel-sidebar__group">
            <h2 class="panel-sidebar__heading">Administración</h2>
            <ul class="panel-sidebar__menu">
                <li class="panel-sidebar__item">
                    <a class="btn-surface-info" href="{{ route('role.index') }}">
                        <i class="btn-surface__icon" data-lucide="shield-check"></i>
                        <span class="btn-surface__text">Roles</span>
                    </a>
                </li>
                <li class="panel-sidebar__item">
                    <a class="btn-surface-info" href="{{ route('user.index') }}">
                        <i class="btn-surface__icon" data-lucide="user"></i>
                        <span class="btn-surface__text">Usuarios</span>
                    </a>
                </li>
            </ul>
        </section>

        <section class="panel-sidebar__group">
            <h2 class="panel-sidebar__heading">Inventario</h2>
            <ul class="panel-sidebar__menu">
                <li class="panel-sidebar__item">
                    <a class="btn-surface-info" href="{{ route('category.index') }}">
                        <i class="btn-surface__icon" data-lucide="layers"></i>
                        <span class="btn-surface__text">Categorías</span>
                    </a>
                </li>
                <li class="panel-sidebar__item">
                    <a class="btn-surface-info" href="{{ route('brand.index') }}">
                        <i class="btn-surface__icon" data-lucide="tag"></i>
                        <span class="btn-surface__text">Marcas</span>
                    </a>
                </li>
                <li class="panel-sidebar__item">
                    <a class="btn-surface-info" href="{{ route('product.index') }}">
                        <i class="btn-surface__icon" data-lucide="box"></i>
                        <span class="btn-surface__text">Productos</span>
                    </a>
                </li>
            </ul>
        </section>
    </div>
    <footer class="panel-sidebar__footer">
        <form method="POST" action="{{ route('auth.logout') }}">
            @csrf
            <button type="submit" class="btn-surface-error">
                <i data-lucide="log-out" class="btn-surface__icon"></i>
                <span class="btn-surface__text">
                    Cerrar sesión
                </span>
            </button>
        </form>
    </footer>
</aside>