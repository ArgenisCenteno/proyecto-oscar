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
                            <h2 class="content-header-title float-start mb-0"> Bienvenido a {{ config('app.name') }}
                            </h2>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleIndicators" class="carousel slide ecommerce-carousel"
                        data-bs-ride="carousel">

                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="2"></button>
                        </div>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('https://images.pexels.com/photos/1488470/pexels-photo-1488470.jpeg') }}"
                                    class="d-block w-100 carousel-img" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('https://images.pexels.com/photos/7679720/pexels-photo-7679720.jpeg') }}"
                                    class="d-block w-100 carousel-img" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('https://images.pexels.com/photos/13532891/pexels-photo-13532891.jpeg') }}"
                                    class="d-block w-100 carousel-img" alt="Third slide">
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>

            <br>
            <br>
            <div class="content-detached ">
                <div class="content-body">
                    <h2>Nuestros productos</h2>

                    <section id="ecommerce-products" class="grid-view">

                        @foreach ($productos as $producto)
                                            <a href="{{ route('shop.show', $producto->slug) }}">
                                                <div class="card ecommerce-card">

                                                    {{-- Imagen --}}
                                                    <div class="item-img text-center">
                                                        <a href="{{ route('shop.show', $producto->slug) }}">
                                                            <img class="img-fluid card-img-top" src="{{ $producto->imagenes->first()
                            ? asset('storage/' . $producto->imagenes->first()->imagen)
                            : asset('app-assets/images/pages/eCommerce/placeholder.png') }}"
                                                                alt="{{ $producto->nombre }}" />
                                                        </a>
                                                    </div>

                                                    {{-- Body --}}
                                                    <div class="card-body">
                                                        <div class="item-wrapper">
                                                            <div class="item-rating">
                                                                <ul class="unstyled-list list-inline">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <li class="ratings-list-item">
                                                                            <i data-feather="star"
                                                                                class="{{ $i <= 4 ? 'filled-star' : 'unfilled-star' }}"></i>
                                                                        </li>
                                                                    @endfor
                                                                </ul>
                                                            </div>

                                                            <div>
                                                                <h6 class="item-price">${{ number_format($producto->precio, 2) }}</h6>
                                                            </div>
                                                        </div>

                                                        {{-- Nombre --}}
                                                        <h6 class="item-name">
                                                            <a class="text-body" href="#">
                                                                {{ $producto->nombre }}
                                                            </a>
                                                            <span class="card-text item-company">
                                                                En <a href="#" class="company-name">
                                                                    {{ $producto->subcategoria->nombre }}
                                                                </a>
                                                            </span>
                                                        </h6>

                                                        {{-- Descripción --}}
                                                        <p class="card-text item-description">
                                                            {{ Str::limit($producto->descripcion, 150) }}
                                                        </p>
                                                    </div>

                                                    {{-- Opciones --}}
                                                    <div class="item-options text-center">
                                                        <div class="item-wrapper">
                                                            <div class="item-cost">
                                                                <h4 class="item-price">${{ number_format($producto->precio, 2) }}</h4>
                                                            </div>
                                                        </div>

                                                        <a href="#" class="btn btn-light btn-wishlist">
                                                           
                                                            <span></span>
                                                        </a>

                                                        <a href="{{route('shop.show', $producto->slug)}}" class="btn btn-primary btn-cart">
                                                            <i data-feather="shopping-cart"></i>
                                                            <span class="add-to-cart2">Ver detalles</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
                        @endforeach

                    </section>


                    <div class="d-flex justify-content-center align-items-center mt-4 mb-4">
                        <button class="btn btn-primary">Ver más productos</button>
                    </div>
                    <section class="saving_section mt-4">
                        <div class="box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="img-box">
                                            <img src="{{ asset('assets/img/saving-img.png') }}" alt="">

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="detail-box">
                                            <div class="heading_container">
                                                <h2>
                                                    Best Savings on <br>
                                                    new arrivals
                                                </h2>
                                            </div>
                                            <p>
                                                Qui ex dolore at repellat, quia neque doloribus omnis adipisci, ipsum
                                                eos odio fugit ut eveniet blanditiis praesentium totam non nostrum
                                                dignissimos nihil eius facere et eaque. Qui, animi obcaecati.
                                            </p>
                                            <div class="btn-box">
                                                <a href="#" class="btn btn-primary">
                                                    Buy Now
                                                </a>
                                                <a href="#" class="btn btn-secondary">
                                                    See More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="why_section py-5 mt-4">
                        <div class="container">

                            <!-- Título -->
                            <div class="row mb-4">
                                <div class="col text-center">
                                    <h2 class="fw-bold">Why Shop With Us</h2>
                                </div>
                            </div>

                            <!-- Cards -->
                            <div class="row g-4">

                                <!-- Item 1 -->
                                <div class="col-md-4">
                                    <div class="box h-100 text-center p-4 border rounded">
                                        <div class="img-box mb-3 d-flex justify-content-center">
                                            <svg width="80" height="80" viewBox="0 0 512 512">
                                                <!-- SVG completo aquí -->
                                            </svg>
                                        </div>
                                        <div class="detail-box">
                                            <h5 class="fw-semibold">Fast Delivery</h5>
                                            <p class="text-muted mb-0">
                                                variations of passages of Lorem Ipsum available
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 2 -->
                                <div class="col-md-4">
                                    <div class="box h-100 text-center p-4 border rounded">
                                        <div class="img-box mb-3 d-flex justify-content-center">
                                            <svg width="80" height="80" viewBox="0 0 490.667 490.667">
                                                <!-- SVG completo aquí -->
                                            </svg>
                                        </div>
                                        <div class="detail-box">
                                            <h5 class="fw-semibold">Free Shipping</h5>
                                            <p class="text-muted mb-0">
                                                variations of passages of Lorem Ipsum available
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 3 -->
                                <div class="col-md-4">
                                    <div class="box h-100 text-center p-4 border rounded">
                                        <div class="img-box mb-3 d-flex justify-content-center">
                                            <svg width="80" height="80" viewBox="0 0 512 512">
                                                <!-- SVG completo aquí -->
                                            </svg>
                                        </div>
                                        <div class="detail-box">
                                            <h5 class="fw-semibold">Best Quality</h5>
                                            <p class="text-muted mb-0">
                                                variations of passages of Lorem Ipsum available
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                    <section class="gift_section layout_padding-bottom">
                        <div class="box ">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="img_container">
                                            <div class="img-box">
                                                <img src="{{ asset('assets/img/gifts.png') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="detail-box">
                                            <div class="heading_container">
                                                <h2 class="text-white">
                                                    Gifts for your <br>
                                                    loved ones
                                                </h2>
                                            </div>
                                            <p>
                                                Omnis ex nam laudantium odit illum harum, excepturi accusamus at
                                                corrupti, velit blanditiis unde perspiciatis, vitae minus culpa? Beatae
                                                at aut consequuntur porro adipisci aliquam eaque iste ducimus expedita
                                                accusantium?
                                            </p>
                                            <div class="btn-box">
                                                <a href="#" class="btn1">
                                                    Buy Now
                                                </a>
                                                <a href="#" class="btn2">
                                                    See More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

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
</body>
<!-- END: Body-->

</html>