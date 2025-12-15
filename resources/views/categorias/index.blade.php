@extends('layouts.app') {{-- ¡Extiende tu layout principal! --}}

@section('title', 'Categorías de Productos') {{-- Título de la página --}}

@section('page_title', 'Categorías de Productos') {{-- Título en el breadcrumb --}}

@section('breadcrumbs') {{-- Breadcrumbs adicionales --}}
    <li class="breadcrumb-item active">Lista</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-end">
             
             <a href="{{ route('categorias.create') }}" class="btn btn-primary">Registrar</a> 
        </div>
        <div class="card-body">
            @include('categorias.table') 
        </div>
    </div>
@endsection

@section('styles')
    {{-- Aquí puedes incluir CSS específicos para esta página si los necesitas --}}
    {{-- @vite(['public/vuexy/app-assets/css/pages/page-products.css']) --}}
@endsection

@section('scripts')

 
@endsection