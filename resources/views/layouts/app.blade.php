<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title', 'Dashboard') - Inv. Conforts</title> {{-- Aquí inyectamos el título --}}
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">


    @yield('vendor-styles') {{-- Para CSS de vendor específicos de la página --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    @yield('page-styles') {{-- Para CSS de página específicos --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    @yield('custom-styles') {{-- Para CSS personalizados --}}
    @yield('styles') {{-- Un comodín para estilos en general --}}

    <style>
        .fade-in-dollar {
            opacity: 0;
            transform: translateY(-5px);
            animation: fadeInDollar 0.8s ease forwards;
            animation-delay: 0.3s;
        }

        @keyframes fadeInDollar {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    @include('layouts.header') {{-- Usamos el parcial del header --}}
    @include('layouts.menu') {{-- Usamos el parcial del menú principal (sidebar) --}}
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">@yield('page_title', 'Dashboard')</h2>
                            {{-- Título de la página en el header --}}
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    Enlace a tu dashboard --}}
                                    @yield('breadcrumbs') {{-- Para breadcrumbs adicionales --}}
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        {{-- Opcional: Contenido adicional en el header de la página, como botones de acción --}}
                        @yield('header-actions')
                    </div>
                </div>
            </div>
            <div class="content-body">
                @yield('content') {{-- ¡Aquí se inyectará el contenido específico de cada vista! --}}
            </div>
        </div>
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('layouts.footer') {{-- Usamos el parcial del footer --}}
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>

    @yield('vendor-scripts') {{-- Para JS de vendor específicos de la página --}}

    @yield('page-vendor-scripts') {{-- Para JS de vendor de página específicos --}}
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    @yield('page-scripts') {{-- Para JS de página específicos --}}
    @yield('scripts') {{-- Un comodín para scripts en general --}}
    @include('sweetalert::alert')

    <script>
        $(window).on('load', function() {
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
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los inputs de tipo text y los textareas
        const textInputs = document.querySelectorAll('input[type="text"], textarea');

        // Itera sobre cada input y textarea y agrega el listener
        textInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                // Convierte el valor del input o textarea a mayúsculas
                this.value = this.value.toUpperCase();
            });
        });
    });
</script>
@include('layouts.dattable_css')
@include('layouts.datatable_js')

<script>
    function revisarErrores() {
        
        const tieneErrores = $('.is-invalid').length > 0;
        $('#btn-submit').prop('disabled', tieneErrores);
    }
</script>

<script>
    $('#telefono').on('input', function() {
        let telefono = $(this).val();
        telefono = telefono.replace(/\D/g, '').slice(0, 11);
        $(this).val(telefono);
        const regex = /^(0412|0424|0414|0426|0416)[0-9]{7}$/;

        if (!regex.test(telefono)) {
            $(this).addClass('is-invalid').removeClass('is-valid');
            // Si no existe el div de feedback, lo insertamos
            if ($(this).next('.invalid-feedback').length === 0) {
                $(this).after('<div class="invalid-feedback"></div>');
            }
            $(this).next('.invalid-feedback').text(
                'Formato incorrecto. Debe comenzar con 0412, 0414, 0424, 0426 o 0416 y tener 11 dígitos.');

        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $(this).next('.invalid-feedback').text('');
        }
        revisarErrores();
    });
</script>
<script>
    $('#telefono2').on('input', function() {
        let telefono = $(this).val();
        telefono = telefono.replace(/\D/g, '').slice(0, 11);
        $(this).val(telefono);
        const regex = /^(0412|0424|0414|0426|0416)[0-9]{7}$/;

        if (!regex.test(telefono)) {
            $(this).addClass('is-invalid').removeClass('is-valid');
            // Si no existe el div de feedback, lo insertamos
            if ($(this).next('.invalid-feedback').length === 0) {
                $(this).after('<div class="invalid-feedback"></div>');
            }
            $(this).next('.invalid-feedback').text(
                'Formato incorrecto. Debe comenzar con 0412, 0414, 0424, 0426 o 0416 y tener 11 dígitos.');

        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $(this).next('.invalid-feedback').text('');
        }
        revisarErrores();
    });
</script>
<script>
    $(document).ready(function() {
        $('#cedula').on('input', function() {
            let cedula = $(this).val();

            // Eliminar cualquier carácter que no sea número
            cedula = cedula.replace(/\D/g, '').slice(0, 8); // máximo 8 dígitos
            $(this).val(cedula);

            // Validar longitud mínima de 7
            if (cedula.length >= 7 && cedula.length <= 8) {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');

                // Si no existe el div de feedback, lo insertamos
                if ($(this).next('.invalid-feedback').length === 0) {
                    $(this).after('<div class="invalid-feedback"></div>');
                }

                $(this).next('.invalid-feedback').text('La cédula debe tener entre 7 y 8 dígitos.');
            }
            revisarErrores();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#dni').on('input', function() {
            let $input = $(this);
            let cedula = $input.val().replace(/\D/g, '').slice(0, 8); // Solo números, máx 8 dígitos
            $input.val(cedula);

            const $feedback = $input.closest('.col-md-6').find('.invalid-feedback');
            const $botonBuscar = $('#btnBuscarCedula');

            if (cedula.length >= 7 && cedula.length <= 8) {
                $input.removeClass('is-invalid').addClass('is-valid');
                $feedback.hide();
                $botonBuscar.prop('disabled', false);
            } else {
                $input.removeClass('is-valid').addClass('is-invalid');
                $feedback.show();
                $botonBuscar.prop('disabled', true);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#rif').on('input', function() {
            let cedula = $(this).val();

            // Eliminar cualquier carácter que no sea número
            cedula = cedula.replace(/\D/g, '').slice(0, 9); // máximo 8 dígitos
            $(this).val(cedula);

            // Validar longitud mínima de 7
            if (cedula.length >= 7 && cedula.length <= 9) {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');

                // Si no existe el div de feedback, lo insertamos
                if ($(this).next('.invalid-feedback').length === 0) {
                    $(this).after('<div class="invalid-feedback"></div>');
                }

                $(this).next('.invalid-feedback').text('El RIF debe tener entre 8 y 9 dígitos.');
            }
            revisarErrores();
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const precioInput = document.getElementById('precio');

        // Solo dejar números y punto mientras escribes (sin formatear en cada input)
        precioInput.addEventListener('input', function(e) {
            let value = e.target.value;
            // Eliminar todo excepto dígitos y puntos
            value = value.replace(/[^0-9.]/g, '');

            // Permitir solo un punto decimal
            const parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }

            e.target.value = value;
        });

        // Al perder foco, formatear con moneda
        precioInput.addEventListener('blur', function(e) {
            let value = e.target.value;
            if (value) {
                const floatValue = parseFloat(value);
                if (!isNaN(floatValue)) {
                    e.target.value = new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD',
                        minimumFractionDigits: 2
                    }).format(floatValue);
                }
            }
        });

        // Al hacer foco, quitar formato para que pueda editar limpio
        precioInput.addEventListener('focus', function(e) {
            let value = e.target.value;
            // Quitar todo excepto números y punto
            value = value.replace(/[^0-9.]/g, '');
            e.target.value = value;
        });

        // Al enviar formulario, dejar valor sin formato
        precioInput.form.addEventListener('submit', function() {
            precioInput.value = precioInput.value.replace(/[^0-9.]/g, '');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const precioInput = document.getElementById('inicial');

        // Solo dejar números y punto mientras escribes (sin formatear en cada input)
        precioInput.addEventListener('input', function(e) {
            let value = e.target.value;
            // Eliminar todo excepto dígitos y puntos
            value = value.replace(/[^0-9.]/g, '');

            // Permitir solo un punto decimal
            const parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }

            e.target.value = value;
        });

        // Al perder foco, formatear con moneda
        precioInput.addEventListener('blur', function(e) {
            let value = e.target.value;
            if (value) {
                const floatValue = parseFloat(value);
                if (!isNaN(floatValue)) {
                    e.target.value = new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD',
                        minimumFractionDigits: 2
                    }).format(floatValue);
                }
            }
        });

        // Al hacer foco, quitar formato para que pueda editar limpio
        precioInput.addEventListener('focus', function(e) {
            let value = e.target.value;
            // Quitar todo excepto números y punto
            value = value.replace(/[^0-9.]/g, '');
            e.target.value = value;
        });

        // Al enviar formulario, dejar valor sin formato
        precioInput.form.addEventListener('submit', function() {
            precioInput.value = precioInput.value.replace(/[^0-9.]/g, '');
        });
    });
</script>
<script>
$(document).ready(function () {
    $('.only-text').on('input', function () {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
    });

    $('.only-text').on('keypress', function (e) {
        let key = String.fromCharCode(e.which);

        // Solo letras y espacios permitidos
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]$/.test(key)) {
            e.preventDefault();
        }
    });
});
</script>
<script>
$(document).on("input", ".moneda", function () {
    let val = $(this).val();

    // Solo números y punto decimal
    val = val.replace(/[^0-9.]/g, "");

    // Solo un punto decimal
    val = val.replace(/(\..*)\./g, "$1");

    // No permitir iniciar con punto
    if (val.startsWith(".")) {
        val = "0" + val;
    }

    $(this).val(val);
});
</script>

 
 
</html>
