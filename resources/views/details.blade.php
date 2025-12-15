<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Product Details - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
        href="../../../app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-ecommerce-details.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-number-input.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover"
    data-menu="horizontal-menu" data-col="">
    <!-- BEGIN: Header-->
      @include('objetos.header')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Detalles del Producto</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Tienda</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Productos</a>
                                    </li>
                                  
                                    <li class="breadcrumb-item active">Detalles
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                    href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span
                                        class="align-middle">Todo</span></a><a class="dropdown-item"
                                    href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span
                                        class="align-middle">Chat</span></a><a class="dropdown-item"
                                    href="app-email.html"><i class="me-1" data-feather="mail"></i><span
                                        class="align-middle">Email</span></a><a class="dropdown-item"
                                    href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span
                                        class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- app e-commerce details start -->
                <section class="app-ecommerce-details">
                    <div class="card">
                        <!-- Product Details starts -->
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center">
                                    <img src="{{ $producto->imagenes->first()
    ? asset('storage/' . $producto->imagenes->first()->imagen)
    : asset('app-assets/images/pages/eCommerce/placeholder.png') }}" class="img-fluid product-img"
                                        alt="{{ $producto->nombre }}" />
                                </div>

                                <div class="col-12 col-md-7">
                                    <h4>{{ $producto->nombre }}</h4>

                                    <span class="card-text item-company">
                                        Categoría:
                                        <a href="#" class="company-name">
                                            {{ $producto->subcategoria->categoria->nombre }}
                                        </a>
                                        /
                                        <a href="#" class="company-name">
                                            {{ $producto->subcategoria->nombre }}
                                        </a>
                                    </span>

                                    <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                        <h4 class="item-price me-1">
                                            ${{ number_format($producto->precio, 2) }}
                                        </h4>

                                        {{-- rating fake por ahora --}}
                                        <ul class="unstyled-list list-inline ps-1 border-start">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <li class="ratings-list-item">
                                                    <i data-feather="star"
                                                        class="{{ $i <= 4 ? 'filled-star' : 'unfilled-star' }}"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>

                                    <p class="card-text">
                                        Disponible:
                                        <span class="{{ $producto->stock > 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $producto->stock > 0 ? 'En stock' : 'Agotado' }}
                                        </span>
                                    </p>

                                    <p class="card-text">
                                        {{ $producto->descripcion }}
                                    </p>
  @if ($producto->variantes->whereNotNull('color')->count())
<hr>
<div class="product-color-options">
    <h6>Colores</h6>

    <ul class="list-unstyled mb-0 d-flex flex-wrap gap-50">
        @foreach ($producto->variantes->unique('color') as $variante)
            <li>
                <button
                    type="button"
                    class="btn btn-outline-secondary btn-sm color-btn"
                    data-color="{{ $variante->color }}"
                >
                    {{ ucfirst(strtolower($variante->color)) }}
                </button>
            </li>
        @endforeach
    </ul>
</div>

@if ($producto->variantes->whereNotNull('talla')->count())
<hr>
<div class="product-size-options">
    <h6>Tallas</h6>
    <div class="btn-group">
        @foreach ($producto->variantes->unique('talla') as $variante)
            <button class="btn btn-outline-secondary btn-sm size-btn" data-talla="{{ $variante->talla }}">
                {{ strtoupper($variante->talla) }}
            </button>
        @endforeach
    </div>
</div>
@endif
<hr />
<div class="row mt-2">
    <div class="col-md-4">
        <div class="input-group quantity-selector">
            <button type="button" class="btn btn-outline-secondary btn-qty" data-action="minus">
                −
            </button>

            <input
                type="text"
                id="cantidad"
                class="form-control text-center"
                value="1"
                readonly
                 data-max="1"
            >

            <button type="button" class="btn btn-outline-secondary btn-qty" data-action="plus">
                +
            </button>
        </div>
    </div>
</div>


<div class="d-flex flex-column flex-sm-row pt-1">
    
    <a href="#" id="btn-add-to-cart" class="btn btn-primary btn-cart me-1"  data-has-variants="{{ $producto->variantes->count() > 0 ? '1' : '0' }}" data-producto="{{ $producto->id }}">
        <i data-feather="shopping-cart"></i>
        <span>Agregar al carrito</span>
    </a>

    <a href="#" class="btn btn-outline-secondary btn-wishlist me-1">
        <i data-feather="heart"></i>
        <span>Favoritos</span>
    </a>
</div>
<ol class="breadcrumb mt-4">
    <li class="breadcrumb-item"><a href="/">Tienda</a></li>
    <li class="breadcrumb-item">
        <a href="#">
            {{ $producto->subcategoria->categoria->nombre }}
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="#">
            {{ $producto->subcategoria->nombre }}
        </a>
    </li>
    <li class="breadcrumb-item active">
        {{ $producto->nombre }}
    </li>
</ol>

@endif
                                </div>
                              

                            </div>
                            <!-- Product Details ends -->

                            <!-- Item features starts -->
                           <div class="item-features">
    <div class="row text-center">
        <div class="col-12 col-md-4 mb-4 mb-md-0">
            <div class="w-75 mx-auto">
                <i data-feather="award"></i>
                <h4 class="mt-2 mb-1">Producto Original</h4>
                <p class="card-text">
                    Prendas 100% originales, seleccionadas con altos estándares de calidad.
                </p>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4 mb-md-0">
            <div class="w-75 mx-auto">
                <i data-feather="clock"></i>
                <h4 class="mt-2 mb-1">Cambios en 10 días</h4>
                <p class="card-text">
                    Puedes solicitar cambios o devoluciones dentro de los primeros 10 días.
                </p>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4 mb-md-0">
            <div class="w-75 mx-auto">
                <i data-feather="shield"></i>
                <h4 class="mt-2 mb-1">Compra Segura</h4>
                <p class="card-text">
                    Tus pagos están protegidos y tu información es totalmente segura.
                </p>
            </div>
        </div>
    </div>
</div>

                            <!-- Item features ends -->

                            <!-- Related Products starts -->
                           <div class="card-body">
    <div class="mt-4 mb-2 text-center">
        <h4>Productos similares</h4>
        <p class="card-text">
            También te pueden interesar
        </p>
    </div>

    <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
        <div class="swiper-wrapper">

            @foreach ($productosRelacionados as $relacionado)
                <div class="swiper-slide">
                    <a href="{{ route('productos.show', $relacionado->slug) }}">

                        <div class="item-heading">
                            <h5 class="text-truncate mb-0">
                                {{ $relacionado->nombre }}
                            </h5>
                            <small class="text-body">
                                {{ $relacionado->subcategoria->nombre }}
                            </small>
                        </div>

                        <div class="img-container w-50 mx-auto py-75">
                            <img
                                src="{{ $relacionado->imagenes->first()
                                    ? asset('storage/' . $relacionado->imagenes->first()->imagen)
                                    : asset('app-assets/images/pages/eCommerce/placeholder.png') }}"
                                class="img-fluid"
                                alt="{{ $relacionado->nombre }}"
                            />
                        </div>

                        <div class="item-meta">
                            <ul class="unstyled-list list-inline mb-25">
                                @for ($i = 1; $i <= 5; $i++)
                                    <li class="ratings-list-item">
                                        <i data-feather="star" class="{{ $i <= 4 ? 'filled-star' : 'unfilled-star' }}"></i>
                                    </li>
                                @endfor
                            </ul>

                            <p class="card-text text-primary mb-0">
                                ${{ number_format($relacionado->precio, 2) }}
                            </p>
                        </div>

                    </a>
                </div>
            @endforeach

        </div>

        <!-- Flechas -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

                            <!-- Related Products ends -->
                        </div>
                </section>
                <!-- app e-commerce details end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2025<a
                    class="ms-25" href="#" target="_blank">{{ config('app.name') }}</a><span
                    class="d-none d-sm-inline-block">, Todos los derechos reservados</span></span><span
                class="float-md-end d-none d-md-block">Construido con Laravel<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-ecommerce-details.js"></script>
    <script src="../../../app-assets/js/scripts/forms/form-number-input.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->
<script>
document.addEventListener('DOMContentLoaded', function () {
    let selectedColor = null;
    let selectedSize = null;
    let selectedVariant = null;

    const qtyInput = document.getElementById('cantidad');
    const btnsQty = document.querySelectorAll('.btn-qty');
    const btnAdd = document.getElementById('btn-add-to-cart');

    // 🔁 Buscar variante según color + talla
    function updateSelectedVariant() {
        if (!selectedColor || !selectedSize) return;

        selectedVariant = window.productVariants.find(v =>
            v.color === selectedColor && v.talla === selectedSize
        );

        if (!selectedVariant) {
            toastr['error']('', 'Esta combinación no está disponible', {
                closeButton: true,
                tapToDismiss: false
            });
            return;
        }

        qtyInput.dataset.max = selectedVariant.stock;
        qtyInput.value = 1;

        if (selectedVariant.stock === 0) {
            toastr['warning']('', 'Esta variante está agotada', {
                closeButton: true,
                tapToDismiss: false
            });
        }
    }

    // 🎨 Color
    document.querySelectorAll('.color-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            selectedColor = this.dataset.color;

            document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            updateSelectedVariant();
        });
    });

    // 📏 Talla
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            selectedSize = this.dataset.talla;

            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            updateSelectedVariant();
        });
    });

    // ➕➖ Cantidad
    btnsQty.forEach(btn => {
        btn.addEventListener('click', function () {
            let qty = parseInt(qtyInput.value);
            let maxStock = parseInt(qtyInput.dataset.max) || 1;

            if (this.dataset.action === 'plus') {
                if (qty >= maxStock) {
                    toastr['warning']('', 'No hay más stock disponible', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    return;
                }
                qty++;
            }

            if (this.dataset.action === 'minus' && qty > 1) {
                qty--;
            }

            qtyInput.value = qty;
        });
    });

    // 🛒 AGREGAR AL CARRITO (🔥 LO QUE FALTABA)
    btnAdd.addEventListener('click', function (e) {
        e.preventDefault();

        const productoId = this.dataset.producto;
        const hasVariants = this.dataset.hasVariants === '1';
        const cantidad = parseInt(qtyInput.value) || 1;

        // VALIDACIONES
        if (hasVariants && !selectedVariant) {
            toastr['warning']('', 'Selecciona color y talla', {
                closeButton: true,
                tapToDismiss: false
            });
            return;
        }

        fetch('/cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                producto_id: productoId,
                variante_id: selectedVariant ? selectedVariant.id : null,
                cantidad: cantidad
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                 const cartCount = document.getElementById('cart-count');
                 console.log(cartCount && data.cart_count !== undefined);
        if (cartCount && data.cart_count !== undefined) {
            cartCount.textContent = data.cart_count;
        }
                btnAdd.innerHTML = `<i data-feather="shopping-cart"></i> <span>Ver carrito</span>`;
                feather.replace();

                toastr['success']('', data.message, {
                    closeButton: true,
                    tapToDismiss: false
                });
            } else {
                toastr['error']('', 'No se pudo agregar al carrito', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }
        })
        .catch(() => {
            toastr['error']('', 'Error de conexión', {
                closeButton: true,
                tapToDismiss: false
            });
        });
    });
});
</script>

@php
    $variants = $producto->variantes->map(function ($v) {
        return [
            'id'     => $v->id,
            'color'  => $v->color,
            'talla'  => $v->talla,
            'stock'  => $v->stock,
            'precio' => $v->precio,
        ];
    });
@endphp
<script>
    window.productVariants = @json($variants);
</script>


 

</html>