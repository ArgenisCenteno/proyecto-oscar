<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center"><a href="#">
            <h6 class="section-label mt-75 mb-0">Files</h6>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
            href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="../../../app-assets/images/icons/xls.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing
                        Manager</small>
                </div>
            </div><small class="search-data-size me-50 text-muted">&apos;17kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
            href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="../../../app-assets/images/icons/jpg.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd
                        Developer</small>
                </div>
            </div><small class="search-data-size me-50 text-muted">&apos;11kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
            href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="../../../app-assets/images/icons/pdf.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital
                        Marketing Manager</small>
                </div>
            </div><small class="search-data-size me-50 text-muted">&apos;150kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
            href="app-file-manager.html">
            <div class="d-flex">
                <div class="me-75"><img src="../../../app-assets/images/icons/doc.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                </div>
            </div><small class="search-data-size me-50 text-muted">&apos;256kb</small>
        </a></li>
    <li class="d-flex align-items-center"><a href="#">
            <h6 class="section-label mt-75 mb-0">Members</h6>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
            href="app-user-view-account.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="../../../app-assets/images/portrait/small/avatar-s-8.jpg" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
            href="app-user-view-account.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd
                        Developer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
            href="app-user-view-account.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="../../../app-assets/images/portrait/small/avatar-s-14.jpg" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing
                        Manager</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
            href="app-user-view-account.html">
            <div class="d-flex align-items-center">
                <div class="avatar me-75"><img src="../../../app-assets/images/portrait/small/avatar-s-6.jpg" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a></li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a
            class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No
                    results found.</span></div>
        </a></li>
</ul>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('dashboard') }}"><span
                        class="brand-logo">
                        <img src="{{ asset('assets/img/logo-tienda.jpg') }}" alt=""> </span>
                    <h2 class="brand-text">{{ config('app.name') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if(Auth::user()->hasRole('SUPERADMIN') || Auth::user()->hasRole('EMPLEADO'))
                <!-- Dashboard -->
                @can('view dashboard')
                    <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ url('/dashboard') }}">
                            <i data-feather="grid"></i>
                            <span class="menu-item text-truncate" data-i18n="Dashboard">Inicio</span>
                        </a>
                    </li>
                @endcan

                <!-- Header -->
                <li class="navigation-header">
                    <span data-i18n="System">Sistema</span>
                    <i data-feather="more-horizontal"></i>
                </li>

                <!-- Categorías -->
                @can('view categorias')
                    <li class="nav-item {{ Request::is('categorias*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('categorias.index') }}">
                            <i data-feather="folder"></i>
                            <span class="menu-title text-truncate" data-i18n="Categories">Categorías</span>
                        </a>
                    </li>
                @endcan

                <!-- Subcategorías -->
                @can('view subcategorias')
                    <li class="nav-item {{ Request::is('subcategorias*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('subcategorias.index') }}">
                            <i data-feather="layers"></i>
                            <span class="menu-title text-truncate" data-i18n="Subcategorías">Subcategorías</span>
                        </a>
                    </li>
                @endcan

                <!-- Productos -->
                @can('view productos')
                    <li class="nav-item {{ Request::is('productos*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('productos.index') }}">
                            <i data-feather="box"></i>
                            <span class="menu-title text-truncate" data-i18n="Productos">Productos</span>
                        </a>
                    </li>
                @endcan

                <!-- Promociones -->
                @can('view promociones')
                    <li class="nav-item {{ Request::is('promociones*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('promociones.index') }}">
                            <i data-feather="tag"></i>
                            <span class="menu-title text-truncate" data-i18n="Promociones">Promociones</span>
                        </a>
                    </li>
                @endcan

                <!-- Cupones -->
                @can('view cupones')
                    <li class="nav-item {{ Request::is('cupones*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cupones.index') }}">
                            <i data-feather="gift"></i>
                            <span class="menu-title text-truncate" data-i18n="Cupones">Cupones</span>
                        </a>
                    </li>
                @endcan

                <!-- Ventas -->
                @canany(['view ventas', 'view pagos'])
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="shopping-cart"></i>
                            <span class="menu-title text-truncate" data-i18n="Sales">Ventas</span>
                        </a>
                        <ul class="menu-content">
                            @can('view ventas')
                                <li class="nav-item {{ Request::is('ventas*') ? 'active' : '' }}">
                                    <a class="d-flex align-items-center" href="{{ route('ventas.index') }}">
                                        <i data-feather="dollar-sign"></i>
                                        <span class="menu-title text-truncate" data-i18n="Ventas">Ventas</span>
                                    </a>
                                </li>
                            @endcan
                            @can('view pagos')
                                <li class="nav-item {{ Request::is('pagos*') ? 'active' : '' }}">
                                    <a class="d-flex align-items-center" href="{{ route('pagos.index') }}">
                                        <i data-feather="credit-card"></i>
                                        <span class="menu-title text-truncate" data-i18n="Pagos">Pagos</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <!-- Usuarios -->
                @can('view usuarios')
                    <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('users.index') }}">
                            <i data-feather="users"></i>
                            <span class="menu-title text-truncate" data-i18n="Usuarios">Usuarios</span>
                        </a>
                    </li>
                @endcan

                <!-- Roles & Permisos -->
                @canany(['view roles', 'view permisos'])
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="shield"></i>
                            <span class="menu-title text-truncate" data-i18n="RolesPermissions">Roles & Permisos</span>
                        </a>
                        <ul class="menu-content">
                            @can('view roles')
                                <li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
                                    <a class="d-flex align-items-center" href="{{ route('roles.index') }}">
                                        <i data-feather="key"></i>
                                        <span class="menu-title text-truncate" data-i18n="Roles">Roles</span>
                                    </a>
                                </li>
                            @endcan
                            @can('view permisos')
                                <li class="nav-item {{ Request::is('permisos*') ? 'active' : '' }}">
                                    <a class="d-flex align-items-center" href="{{ route('permisos.index') }}">
                                        <i data-feather="unlock"></i>
                                        <span class="menu-title text-truncate" data-i18n="Permisos">Permisos</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <!-- Reportes -->
                @can('view reportes')
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="bar-chart"></i>
                            <span class="menu-title text-truncate" data-i18n="Reports">Reportes</span>
                        </a>
                        <ul class="menu-content">
                           <li>
    <a class="d-flex align-items-center" href="{{ route('reportes.ventas') }}">
        <i data-feather="trending-up"></i>
        <span class="menu-item">Ventas</span>
    </a>
</li>

<li>
    <a class="d-flex align-items-center" href="{{ route('reportes.clientes') }}">
        <i data-feather="user-check"></i>
        <span class="menu-item">Clientes</span>
    </a>
</li>

                        </ul>
                    </li>
                @endcan

                <!-- Auditoría -->
                @can('view auditoria')
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="activity"></i>
                            <span class="menu-title text-truncate" data-i18n="Audit">Auditoría</span>
                        </a>
                    </li>
                @endcan
            @else
               <li class="nav-item {{ Request::is('ventas*') ? 'active' : '' }}">
    <a class="d-flex align-items-center" href="{{ route('ventas.index') }}">
        <i data-feather="shopping-bag"></i>
        <span class="menu-title text-truncate" data-i18n="Ventas">Ventas</span>
    </a>
</li>

<li class="nav-item {{ Request::is('pagos*') ? 'active' : '' }}">
    <a class="d-flex align-items-center" href="{{ route('pagos.index') }}">
        <i data-feather="credit-card"></i>
        <span class="menu-title text-truncate" data-i18n="Pagos">Pagos</span>
    </a>
</li>

<li class="nav-item {{ Request::is('cart*') ? 'active' : '' }}">
    <a class="d-flex align-items-center" href="{{ route('cart.index') }}">
        <i data-feather="shopping-cart"></i>
        <span class="menu-title text-truncate" data-i18n="MiCarrito">Mi carrito</span>
    </a>
</li>

<li class="nav-item {{ Request::is('tienda*') ? 'active' : '' }}">
    <a class="d-flex align-items-center" href="{{ url('/') }}">
        <i data-feather="shopping-bag"></i>
        <span class="menu-title text-truncate" data-i18n="Tienda">Tienda</span>
    </a>
</li>

<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="d-flex align-items-center" href="{{ route('users.index') }}">
        <i data-feather="user"></i>
        <span class="menu-title text-truncate" data-i18n="Perfil">Perfil</span>
    </a>
</li>
<li class="nav-item {{ Request::is('perfil/direccion') ? 'active' : '' }}">
    <a class="d-flex align-items-center" href="{{ route('perfil.direccion') }}">
        <i data-feather="map-pin"></i>
        <span class="menu-title text-truncate" data-i18n="Dirección">Dirección</span>
    </a>
</li>


            @endif
        </ul>

    </div>
</div>
<!-- END: Main Menu-->