@extends('layouts.app') {{-- ¡Extiende tu layout principal! --}}

@section('title', 'Panel de Administración') {{-- Título de la página --}}

@section('page_title', 'Panel de Administración') {{-- Título en el breadcrumb --}}

@section('breadcrumbs') {{-- Breadcrumbs adicionales --}}
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('content')
    <section id="dashboard-ecommerce">
                    <div class="row match-height">
                        <!-- Medal Card -->
                      
@if(Auth::user()->hasRole('SUPERADMIN|EMPLEADO'))
  <div class="col-xl-12 col-md-12 col-12">
    <div class="card card-statistics">
        <div class="card-header">
            <h4 class="card-title">Estadísticas</h4>
            <div class="d-flex align-items-center">
                <p class="card-text font-small-2 me-25 mb-0">Actualizado hace 1 mes</p>
            </div>
        </div>
        <div class="card-body statistics-body">
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-primary me-2">
                            <div class="avatar-content">
                                <i data-feather="trending-up" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">{{ $estadisticas['ventas'] }}</h4>
                            <p class="card-text font-small-3 mb-0">Ventas</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-info me-2">
                            <div class="avatar-content">
                                <i data-feather="user" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">{{ $estadisticas['clientes'] }}</h4>
                            <p class="card-text font-small-3 mb-0">Clientes</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-danger me-2">
                            <div class="avatar-content">
                                <i data-feather="box" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">{{ $estadisticas['productos'] }}</h4>
                            <p class="card-text font-small-3 mb-0">Productos</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="d-flex flex-row">
                        <div class="avatar bg-light-success me-2">
                            <div class="avatar-content">
                                <i data-feather="dollar-sign" class="avatar-icon"></i>
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0">${{ number_format($estadisticas['ingresos'], 2) }}</h4>
                            <p class="card-text font-small-3 mb-0">Ingresos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->hasRole('CLIENTE'))
   <div class="col-xl-12 col-md-12 col-12">
    <div class="card card-statistics">
        <div class="card-header">
            <h4 class="card-title">Estadísticas</h4>
            
        </div>
        <div class="card-body statistics-body">
            <div class="row">
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <div class="d-flex flex-row">
            <div class="avatar bg-light-primary me-2">
                <div class="avatar-content">
                    <i data-feather="shopping-bag" class="avatar-icon"></i>
                </div>
            </div>
            <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ $estadisticas['ventas'] }}</h4>
                <p class="card-text font-small-3 mb-0">Compras</p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <div class="d-flex flex-row">
            <div class="avatar bg-light-info me-2">
                <div class="avatar-content">
                    <i data-feather="clock" class="avatar-icon"></i>
                </div>
            </div>
            <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ $estadisticas['ultima_venta'] }}</h4>
                <p class="card-text font-small-3 mb-0">Última compra</p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
        <div class="d-flex flex-row">
            <div class="avatar bg-light-danger me-2">
                <div class="avatar-content">
                    <i data-feather="package" class="avatar-icon"></i>
                </div>
            </div>
            <div class="my-auto">
                <h4 class="fw-bolder mb-0">{{ $estadisticas['productos'] }}</h4>
                <p class="card-text font-small-3 mb-0">Productos comprados</p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="d-flex flex-row">
            <div class="avatar bg-light-success me-2">
                <div class="avatar-content">
                    <i data-feather="credit-card" class="avatar-icon"></i>
                </div>
            </div>
            <div class="my-auto">
                <h4 class="fw-bolder mb-0">
                    ${{ number_format($estadisticas['ingresos'], 2) }}
                </h4>
                <p class="card-text font-small-3 mb-0">Total Comprado</p>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>  
 @endif                      
                     
<!--/ Estadísticas -->
@if(Auth::user()->hasRole('SUPERADMIN|EMPLEADO'))
<div class="row">
    <!-- Productos más vendidos -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Productos más vendidos</h4>
            </div>
            <div class="card-body">
                <div id="productos-chart"></div>
            </div>
        </div>
    </div>

    <!-- Ventas mensuales -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ventas mensuales</h4>
            </div>
            <div class="card-body">
                <div id="ventas-mensuales-chart"></div>
            </div>
        </div>
    </div>
</div>
@endif
@if(Auth::user()->hasRole('SUPERADMIN|EMPLEADO'))
<script>
document.addEventListener("DOMContentLoaded", function () {

 // Productos más vendidos (Donut)
    const productosData = @json($productosData->toArray());
    const productosLabels = @json($productosLabels->toArray());

    var productosChart = new ApexCharts(document.querySelector("#productos-chart"), {
        chart: {
            type: 'donut',
            height: 300
        },
        series: productosData,
        labels: productosLabels,
        colors: ['#7367F0', '#28C76F', '#FF9F43', '#00CFE8', '#EA5455'], // colores para diferenciar
        legend: {
            position: 'bottom'
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(1) + '%';
            }
        },
        tooltip: {
            y: {
                formatter: val => val + ' unidades'
            }
        }
    });

    productosChart.render();

    // Ventas mensuales (Line)
    const ventasData = @json(array_values($ventasMensuales->toArray()));
    const ventasLabels = @json(array_keys($ventasMensuales->toArray()));

    var ventasChart = new ApexCharts(document.querySelector("#ventas-mensuales-chart"), {
        chart: { type: 'line', height: 300 },
        series: [{ name: 'Ingresos', data: ventasData }],
        xaxis: { categories: ventasLabels.map(m => 'Mes ' + m) },
        stroke: { curve: 'smooth' },
        colors: ['#7367F0'],
        dataLabels: { enabled: false },
        tooltip: { y: { formatter: val => '$' + val.toFixed(2) } }
    });
    ventasChart.render();
});
</script>
@endif
                    </div>

                  
                </section>
@endsection

@section('styles')
    {{-- Aquí puedes incluir CSS específicos para esta página si los necesitas --}}
    {{-- @vite(['public/vuexy/app-assets/css/pages/page-products.css']) --}}
@endsection

@section('scripts')

 
@endsection