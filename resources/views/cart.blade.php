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
    <title>Shop - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/nouislider.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-sliders.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu content-detached-left-sidebar navbar-floating footer-static  "
    data-open="hover" data-menu="horizontal-menu" data-col="content-detached-left-sidebar">

    @include('objetos.header')
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0"> Carrito de compras
                            </h2>

                        </div>
                    </div>
                </div>

            </div>


            <div class="content-detached ">
                <div class="content-body">
                    <div class="bs-stepper-content">
                        <!-- Checkout Place order starts -->
                        <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
                            <div id="place-order" class="list-view product-checkout">
                                <!-- Checkout Place Order Left starts -->
                                <div class="checkout-items">
                                    @forelse ($items as $item)

                                                                    @php
                                                                        $producto = auth()->check() ? $item->producto : App\Models\Producto::find($item['producto_id']);
                                                                        $variante = auth()->check() ? $item->variante : null;
                                                                        $cantidad = auth()->check() ? $item->cantidad : $item['cantidad'];
                                                                        $precio = auth()->check() ? $item->precio : $item['precio'];
                                                                    @endphp
                                                                    <div class="card ecommerce-card cart-item">
                                                                        <div class="item-img">
                                                                            <a href="app-ecommerce-details.html">
                                                                                <img src="{{ $producto->imagenes->first()
                                        ? asset('storage/' . $producto->imagenes->first()->imagen)
                                        : asset('app-assets/images/pages/eCommerce/placeholder.png') }}" alt="img-placeholder" />
                                                                            </a>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="item-name">
                                                                                <h6 class="mb-0">{{ $producto->nombre }}</h6>
                                                                                 @if($variante)
            <small class="text-muted">
                Color: {{ $variante->color }} |
                Talla: {{ $variante->talla }}
            </small>
        @endif
                                                               
                                                                                <div class="item-rating">
                                                                                    <ul class="unstyled-list list-inline">
                                                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                                                class="filled-star"></i></li>
                                                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                                                class="filled-star"></i></li>
                                                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                                                class="filled-star"></i></li>
                                                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                                                class="filled-star"></i></li>
                                                                                        <li class="ratings-list-item"><i data-feather="star"
                                                                                                class="unfilled-star"></i></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <span class="text-success mb-1">In Stock</span>
                                                                          <div class="item-quantity mt-1 d-flex align-items-center gap-50">
    <span class="quantity-title me-50">Cant:</span>
                             @php
$total = 0;
foreach ($items as $item) {
    $total += auth()->check()
        ? $item->precio * $item->cantidad
        : $item['precio'] * $item['cantidad'];
}
@endphp
@php
    $key = auth()->check()
        ? $item->id
        : $item['producto_id'].'-'.$item['variante_id'];
@endphp
    <div class="input-group input-group-sm quantity-counter-wrapper" style="width: 110px;">
        <button
            class="btn btn-outline-secondary btn-qty px-50"
            data-action="minus"
            data-id="{{ auth()->check() ? $item->id : $key }}">
            −
        </button>

        <input
            type="text"
            class="form-control text-center px-25 item-qty"
            value="{{ $cantidad }}"
            readonly
        >

        <button
            class="btn btn-outline-secondary btn-qty px-50"
            data-action="plus"
            data-id="{{ auth()->check() ? $item->id : $key }}">
            +
        </button>
    </div>
</div>

                                                                            
                                                                        </div>
                                                                       <div class="item-options text-center">
        <h4 class="item-price"  data-price="{{ $precio }}">${{ number_format($precio * $cantidad, 2) }}</h4>

        <button class="btn btn-light mt-1 btn-remove"
            data-id="{{ $key}}">
        <i data-feather="x"></i> Quitar
    </button>
    </div>
                                                                    </div>
                                    @empty
                                        <p class="text-muted">Tu carrito está vacío</p>
                                    @endforelse
                                </div>
                                <!-- Checkout Place Order Left ends -->

                                <!-- Checkout Place Order Right starts -->
 

<div class="checkout-options">
    <div class="card">
        <div class="card-body">
            <h6 class="price-title">Resumen</h6>

            <ul class="list-unstyled">
                <li class="price-detail" id="cart-total-2">
                    <span>Total productos</span>
                    <span>${{ number_format($total ?? 0, 2) }}</span>
                </li>

                <li class="price-detail">
                    <span>Envío</span>
                    <span class="text-success">Gratis</span>
                </li>
            </ul>

            <hr>

            <div class="price-detail " id="cart-total">
                <strong>Total a pagar</strong>
                <strong>${{ number_format($total ?? 0, 2) }}</strong>
            </div>
             <div class="price-detail " id="cart-total-dollar">
                <strong>Total a pagar (Bs)</strong>
                <strong>${{ number_format($total ?? 0 * $dollar ?? 0, 2) }}</strong>
            </div>

            <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 mt-2">
    Continuar con la compra
</a>

        </div>
    </div>
</div>

                            </div>
                            <!-- Checkout Place order Ends -->
                        </div>

                    </div>


                </div>
            </div>


        </div>
    </div>
    <!-- END: Content-->
    <style>
        /* Carousel ecommerce */
        .ecommerce-carousel {
            max-height: 520px;
            overflow: hidden;
            border-radius: 12px;
        }

        .ecommerce-carousel .carousel-item {
            height: 520px;
        }

        .ecommerce-carousel .carousel-img {
            height: 100%;
            object-fit: cover;
        }
    </style>

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
    <script src="../../../app-assets/vendors/js/extensions/wNumb.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/nouislider.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-ecommerce.js"></script>
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
   <script>
document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.btn-qty').forEach(btn => {
        btn.addEventListener('click', function () {

            const action = this.dataset.action
            const id = this.dataset.id
            const card = this.closest('.cart-item')
            const input = card.querySelector('.item-qty')
            const priceEl = card.querySelector('.item-price')
            const unitPrice = parseFloat(priceEl.dataset.price)

            fetch("{{ route('cart.update.quantity') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ action, id })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    toastr.warning(data.message || 'Error')
                    return
                }

                // 🔹 Actualizar cantidad
                input.value = data.cantidad

                // 🔹 Actualizar subtotal del producto
                const subtotal = (unitPrice * data.cantidad).toFixed(2)
                priceEl.innerText = `$${subtotal}`

                // 🔹 Recalcular totales
                updateCartTotals()
            })
        })
    })

})

function updateCartTotals() {
    let total = 0;
    let total2 = 0;
    let tasa = Number(@json($dollar));

    document.querySelectorAll('.cart-item').forEach(card => {
        const priceEl = card.querySelector('.item-price');
        if (!priceEl) return;

        const price = parseFloat(
            priceEl.innerText.replace(/[^0-9.]/g, '')
        );

        if (isNaN(price)) return;

        total += price;
        total2 += price * tasa;
    });

    document.querySelector('#cart-total strong:last-child').innerText =
        `$${total.toFixed(2)}`;

    document.querySelector('#cart-total-2 span:last-child').innerText =
        `$${total.toFixed(2)}`;

    document.querySelector('#cart-total-dollar strong:last-child').innerText =
        `$${total2.toFixed(2)}`;
}


</script>


</body>
<!-- END: Body--> 
<script>
document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.btn-remove').forEach(btn => {
        btn.addEventListener('click', function () {

            const id = this.dataset.id
            const card = this.closest('.cart-item')

            fetch(`{{ url('/cart') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    toastr.error('Error al eliminar')
                    return
                }

                window.location.reload();


                // 👉 Si el carrito queda vacío
                if (document.querySelectorAll('.cart-item').length === 0) {
                    location.reload()
                }
            })
        })
    })

})


</script>

</html>