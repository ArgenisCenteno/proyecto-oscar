@extends('layouts.app') {{-- ¡Extiende tu layout principal! --}}

@section('title', 'Editar rol') {{-- Título de la página --}}

@section('page_title', 'Editar rol') {{-- Título en el breadcrumb --}}

@section('breadcrumbs') {{-- Breadcrumbs adicionales --}}
    <li class="breadcrumb-item active">Crear</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-end">
             
             <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver</a> 
        </div>
        <div class="card-body">
            @include('roles.edit_fields') 
        </div>
    </div>
@endsection

@section('styles')
    {{-- Aquí puedes incluir CSS específicos para esta página si los necesitas --}}
    {{-- @vite(['public/vuexy/app-assets/css/pages/page-products.css']) --}}
@endsection

@section('scripts')

 
@endsection