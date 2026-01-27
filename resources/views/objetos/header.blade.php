<!-- BEGIN: Header-->
<nav class="pt-1 header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center"
    data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a class="navbar-brand" href="{{url('/')}}"><span class="brand-logo">
                   <img src="{{ asset('assets/img/logo-tienda.jpg') }}" style="max-width: 60px; width: 100%; height: auto;">
 </span>
                    <h2 class="brand-text mb-0">{{ config('app.name') }}</h2>
                </a></li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon"
                            data-feather="menu"></i></a></li>
            </ul>

            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block">
                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0"
                            data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
           
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                        data-feather="moon"></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
                        data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <form action="{{ route('shop.search') }}" method="GET" class="search-input">
                        <div class="search-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" name="q" placeholder="Buscar productos" required
                            minlength="2" maxlength="50" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ\s]+"
                            title="Solo letras y números">
                        <button type="submit" hidden></button>
                    </form>
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>

                </div>
            </li>

           <li class="nav-item">
    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
        <i class="ficon" data-feather="shopping-cart"></i>

        @if($cartCount > 0)
            <span id="cart-count" class="badge rounded-pill bg-primary badge-up">
                {{ $cartCount }}
            </span>
        @endif
    </a>
</li>
 <div class="d-block ms-1 fade-in-dollar"
                style="background: rgba(0, 123, 255, 0.1); padding: 4px 10px; border-radius: 20px;">
                <i class="ficon text-primary me-25" data-feather="dollar-sign" style="width: 16px; height: 16px;"></i>
                <span class="fw-bold text-primary" style="font-size: 13px;">
                    {{ number_format($dollar, 2, ',', '.') }} Bs
                </span>
            </div>
  @auth
            <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#"
                    data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span
                        class="badge rounded-pill bg-danger badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                            <div class="badge rounded-pill badge-light-primary">6 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list"><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar"><img
                                            src="../../../app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar"
                                            width="32" height="32"></div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Congratulation Sam
                                            🎉</span>winner!</p><small class="notification-text"> Won the monthly
                                        best seller badge.</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar"><img
                                            src="../../../app-assets/images/portrait/small/avatar-s-3.jpg" alt="avatar"
                                            width="32" height="32"></div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">New
                                            message</span>&nbsp;received</p><small class="notification-text"> You
                                        have 10 unread messages</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">MD</div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Revised Order
                                            👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc.
                                        order updated</small>
                                </div>
                            </div>
                        </a>
                        <div class="list-item d-flex align-items-center">
                            <h6 class="fw-bolder me-auto mb-0">System Notifications</h6>
                            <div class="form-check form-check-primary form-switch">
                                <input class="form-check-input" id="systemNotification" type="checkbox" checked="">
                                <label class="form-check-label" for="systemNotification"></label>
                            </div>
                        </div><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Server
                                            down</span>&nbsp;registered</p><small class="notification-text"> USA
                                        Server is down due to hight CPU usage</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-success">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Sales
                                            report</span>&nbsp;generated</p><small class="notification-text"> Last
                                        month sales report generated</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-warning">
                                        <div class="avatar-content"><i class="avatar-icon"
                                                data-feather="alert-triangle"></i></div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">High memory</span>&nbsp;usage
                                    </p><small class="notification-text"> BLR Server using high memory</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Read all
                            notifications</a></li>
                </ul>
            </li>
            @endauth
           @auth
<li class="nav-item dropdown dropdown-user">
    <a class="nav-link dropdown-toggle dropdown-user-link"
       href="#"
       id="dropdown-user"
       data-bs-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false">

        <div class="user-nav d-sm-flex d-none">
            <span class="user-name fw-bolder">{{ auth()->user()->name }}</span>
        </div>

        <span class="avatar">
            <img class="round"
                 src="{{ auth()->user()->avatar
                        ? asset('storage/' . auth()->user()->avatar)
                        : asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}"
                 alt="avatar"
                 height="40"
                 width="40">
            <span class="avatar-status-online"></span>
        </span>
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
        <a class="dropdown-item" href="{{ route('dashboard') }}">
            <i class="me-50" data-feather="home"></i>
            Dashboard
        </a>

        <div class="dropdown-divider"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item text-danger">
                <i class="me-50" data-feather="power"></i>
                Cerrar sesión
            </button>
        </form>
    </div>
</li>
@endauth
@guest
<li class="nav-item">
    <a class="nav-link ml-4" href="{{ route('login') }}">
         Ingresar
       
    </a>
</li>

<li class="nav-item">
    <a class="nav-link me-25" href="{{ route('register') }}">
          Registrarse
        
    </a>
</li>
@endguest

        </ul>
    </div>
</nav>



<!-- BEGIN: Main Menu-->
<div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border container-xxl"
        role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand"
                        href="{{route('dashboard')}}"><span class="brand-logo">
                             <img src="{{ asset('assets/img/logo-tienda.jpg') }}" alt=""> </span>
                        <h2 class="brand-text mb-0">{{ config('app.name') }}</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                            class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <!-- include ../../../includes/mixins-->
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

                @foreach ($categorias as $categoria)
                    <li class="dropdown nav-item" data-menu="dropdown">
                        <a class="dropdown-toggle nav-link d-flex align-items-center"
                            href="{{route('shop.categoria', $categoria->id)}}" data-bs-toggle="dropdown">


                            <span>{{ $categoria->nombre }}</span>
                        </a>

                        @if ($categoria->subcategorias->count())
                            <ul class="dropdown-menu" data-bs-popper="none">
                                @foreach ($categoria->subcategorias as $subcategoria)
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('shop.subcategoria', $subcategoria->id) }}">
                                            <i data-feather="chevron-right"></i>
                                            <span>{{ $subcategoria->nombre }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

            </ul>

        </div>
    </div>
</div>