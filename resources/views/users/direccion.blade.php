@extends('layouts.app') {{-- ¡Extiende tu layout principal! --}}

@section('title', 'Mi dirección') {{-- Título de la página --}}

@section('page_title', 'Mi dirección') {{-- Título en el breadcrumb --}}

@section('breadcrumbs') {{-- Breadcrumbs adicionales --}}
    <li class="breadcrumb-item active">Crear</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-end">
             
         </div>
        <div class="card-body">
             <form action="{{ route('perfil.direccion.store') }}" method="POST">
    @csrf

    <div class="row">

        <div class="col-md-6 mb-3">
            <label>Alias</label>
            <input type="text" name="alias" class="form-control @error('alias') is-invalid @enderror"
                   value="{{ old('alias', $direccion->alias ?? '') }}" required>
            @error('alias')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                   value="{{ old('telefono', $direccion->telefono ?? '') }}" required>
            @error('telefono')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label>País</label>
            <input type="text" name="pais" class="form-control @error('pais') is-invalid @enderror"
                   value="{{ old('pais', $direccion->pais ?? '') }}" required>
            @error('pais')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label>Estado</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror"
                   value="{{ old('estado', $direccion->estado ?? '') }}" required>
            @error('estado')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label>Ciudad</label>
            <input type="text" name="ciudad" class="form-control @error('ciudad') is-invalid @enderror"
                   value="{{ old('ciudad', $direccion->ciudad ?? '') }}" required>
            @error('ciudad')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label>Código Postal</label>
            <input type="text" name="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror"
                   value="{{ old('codigo_postal', $direccion->codigo_postal ?? '') }}">
            @error('codigo_postal')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-8 mb-3">
            <label>Dirección</label>
            <textarea name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                      rows="2" required>{{ old('direccion', $direccion->direccion ?? '') }}</textarea>
            @error('direccion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-12 mb-3">
            <div class="form-check">
                <input class="form-check-input @error('predeterminada') is-invalid @enderror"
                       type="checkbox" name="predeterminada" value="1"
                       {{ old('predeterminada', $direccion->predeterminada ?? false) ? 'checked' : '' }}>
                <label class="form-check-label">
                    Dirección predeterminada
                </label>
            </div>
            @error('predeterminada')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

    </div>

    <button class="btn btn-primary">
        {{ $direccion ? 'Actualizar Dirección' : 'Guardar Dirección' }}
    </button>

</form>

        </div>
    </div>
@endsection

@section('styles')
    {{-- Aquí puedes incluir CSS específicos para esta página si los necesitas --}}
    {{-- @vite(['public/vuexy/app-assets/css/pages/page-products.css']) --}}
@endsection

@section('scripts')

 
@endsection