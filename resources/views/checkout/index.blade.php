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
                            <h2 class="content-header-title float-start mb-0">Checkout</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Tienda</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Checkout</a>
                                    </li>

                                    <li class="breadcrumb-item active">Pagar
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

                <form action="{{ route('ventas.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        {{-- Número de productos --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Número de productos</label>
                            <input type="text" class="form-control" value="{{ $totalItems }}" readonly>
                        </div>

                        {{-- Total USD --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total (USD)</label>
                            <input type="text" class="form-control" value="${{ number_format($totalUsd, 2) }}" readonly>
                        </div>

                        {{-- Total Bs --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total en Bs</label>
                            <input type="text" class="form-control" value="Bs {{ number_format($totalBs, 2) }}"
                                readonly>
                        </div>

                        {{-- Método de pago --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Método de Pago</label>
                            <select name="metodo_pago" class="form-control" required>
                                <option value="">Seleccione un método</option>
                                <option value="transferencia">Transferencia</option>
                                <option value="pago_movil">Pago Móvil</option>
                            </select>
                        </div>

                        {{-- Banco origen --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Banco / Cuenta Origen</label>
                            <select name="origen" class="form-control">
                                <option value="">Seleccione Banco</option>
                                <option value="Banesco">Banesco</option>
                                <option value="Mercantil">Mercantil</option>
                                <option value="Venezuela">Banco de Venezuela</option>
                                <option value="BOD">BOD</option>
                                <option value="Provincial">Banco Provincial</option>
                                <option value="Caroni">Banco Caroní</option>
                                <option value="Bicentenario">Bicentenario</option>
                                <option value="exterior">Banco Exterior</option>
                                <option value="DelSur">Del Sur</option>
                                <option value="activos">Banco Activo</option>
                            </select>
                        </div>

                        {{-- Banco destino --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Banco / Cuenta Destino</label>
                            <select name="destino" class="form-control">
                                <option value="">Seleccione Banco</option>
                                <option value="Banesco">Banesco</option>
                                <option value="Mercantil">Mercantil</option>
                                <option value="Venezuela">Banco de Venezuela</option>
                                <option value="BOD">BOD</option>
                                <option value="Provincial">Banco Provincial</option>
                                <option value="Caroni">Banco Caroní</option>
                                <option value="Bicentenario">Bicentenario</option>
                                <option value="exterior">Banco Exterior</option>
                                <option value="DelSur">Del Sur</option>
                                <option value="activos">Banco Activo</option>
                            </select>
                        </div>

                        {{-- Referencia / Número de transferencia --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Referencia (Últimos 8 digitos)</label>
                            <input type="number" name="referencia" class="form-control" placeholder="Últimos 8 dígitos"
                                min="0" max="99999999"
                                oninput="if(this.value.length > 8) this.value = this.value.slice(0,8);" required>
                        </div>

                    </div>
{{-- Información del pago --}}
<div class="col-12 mb-3" id="datos-pago" style="display:none;">
    <div class="card border">
        <div class="card-body">

            {{-- Transferencia --}}
            <div id="pago-transferencia" style="display:none;">
                <h6 class="mb-2">Datos para Transferencia</h6>

                <p>
                    <strong>Banco:</strong> 
                    <span id="t-banco">Banco de Venezuela</span>
                    <button type="button" class="btn btn-sm btn-link" onclick="copiar('t-banco')">Copiar</button>
                </p>

                <p>
                    <strong>Cuenta:</strong> 
                    <span id="t-cuenta">0102-1234-56-1234567890</span>
                    <button type="button" class="btn btn-sm btn-link" onclick="copiar('t-cuenta')">Copiar</button>
                </p>

                <p>
                    <strong>RIF:</strong> 
                    <span id="t-rif">J-12345678-9</span>
                    <button type="button" class="btn btn-sm btn-link" onclick="copiar('t-rif')">Copiar</button>
                </p>
            </div>

            {{-- Pago móvil --}}
            <div id="pago-movil" style="display:none;">
                <h6 class="mb-2">Datos para Pago Móvil</h6>

                <p>
                    <strong>Banco:</strong> 
                    <span id="p-banco">Banco de Venezuela</span>
                    <button type="button" class="btn btn-sm btn-link" onclick="copiar('p-banco')">Copiar</button>
                </p>

                <p>
                    <strong>Teléfono:</strong> 
                    <span id="p-telefono">0414-1234567</span>
                    <button type="button" class="btn btn-sm btn-link" onclick="copiar('p-telefono')">Copiar</button>
                </p>

                <p>
                    <strong>Cédula:</strong> 
                    <span id="p-cedula">V-12345678</span>
                    <button type="button" class="btn btn-sm btn-link" onclick="copiar('p-cedula')">Copiar</button>
                </p>
            </div>

        </div>
    </div>
</div>

                    <input type="hidden" name="direccion_id" value="{{ $direccion->id }}">

                    <button type="submit" class="btn btn-primary w-100 mt-3">Confirmar Compra</button>
                </form>

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

<script>
    // Escucha el evento 'input' en todos los campos de tipo text y textareas y convierte a mayúsculas
    document.addEventListener('DOMContentLoaded', function () {
        // Selecciona todos los inputs de tipo text y los textareas
        const textInputs = document.querySelectorAll('input[type="text"], textarea');

        // Itera sobre cada input y textarea y agrega el listener
        textInputs.forEach(function (input) {
            input.addEventListener('input', function () {
                // Convierte el valor del input o textarea a mayúsculas
                this.value = this.value.toUpperCase();
            });
        });
    });
</script>

<script>
    const metodoPago = document.querySelector('[name="metodo_pago"]');
    const datosPago = document.getElementById('datos-pago');
    const transferencia = document.getElementById('pago-transferencia');
    const pagoMovil = document.getElementById('pago-movil');

    metodoPago.addEventListener('change', function () {
        datosPago.style.display = 'block';
        transferencia.style.display = 'none';
        pagoMovil.style.display = 'none';

        if (this.value === 'transferencia') {
            transferencia.style.display = 'block';
        }

        if (this.value === 'pago_movil') {
            pagoMovil.style.display = 'block';
        }

        if (this.value === '') {
            datosPago.style.display = 'none';
        }
    });
 
    function copiar(id) {
        const texto = document.getElementById(id).innerText;
        navigator.clipboard.writeText(texto).then(() => {
             toastr['success']('', 'Copiado al portapapeles', {
                    closeButton: true,
                    tapToDismiss: false
                });
        });
    }
</script>

</html>