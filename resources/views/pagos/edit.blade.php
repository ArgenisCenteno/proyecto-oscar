@extends('layouts.app') {{-- ¡Extiende tu layout principal! --}}

@section('title', 'Editar Pago') {{-- Título de la página --}}

@section('page_title', 'Editar Pago') {{-- Título en el breadcrumb --}}

@section('breadcrumbs') {{-- Breadcrumbs adicionales --}}
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-end">
             
             <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Volver</a> 
        </div>
        <div class="card-body">
            @include('pagos.fields') 
        </div>
    </div>
@endsection

@section('styles')
    {{-- Aquí puedes incluir CSS específicos para esta página si los necesitas --}}
    {{-- @vite(['public/vuexy/app-assets/css/pages/page-products.css']) --}}
@endsection

@section('scripts')

 
@endsection