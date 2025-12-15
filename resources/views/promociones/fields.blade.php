 
    <form action="{{ route('promociones.store') }}" method="POST">
        @csrf

        <div class="row">

            {{-- Nombre --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre') }}" required>
                @error('nombre')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tipo --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Tipo de descuento</label>
                <select name="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                    <option value="">Seleccione</option>
                    <option value="porcentaje" {{ old('tipo')=='porcentaje' ? 'selected' : '' }}>Porcentaje (%)</option>
                    <option value="fijo" {{ old('tipo')=='fijo' ? 'selected' : '' }}>Monto Fijo</option>
                </select>
                @error('tipo')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Valor --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Valor</label>
                <input type="number" step="0.01" name="valor" class="form-control @error('valor') is-invalid @enderror"
                       value="{{ old('valor') }}" required>
                @error('valor')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Compra mínima --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Compra mínima</label>
                <input type="number" step="0.01" name="minimo"
                       class="form-control @error('minimo') is-invalid @enderror"
                       value="{{ old('minimo') }}">
                @error('minimo')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Categoría --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Categoría</label>
                <select name="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
                    <option value="">Ninguna</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ old('categoria_id')==$cat->id ? 'selected' : '' }}>
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Subcategoría --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Subcategoría</label>
                <select name="subcategoria_id" class="form-control @error('subcategoria_id') is-invalid @enderror">
                    <option value="">Ninguna</option>
                    @foreach($subcategorias as $sub)
                        <option value="{{ $sub->id }}" {{ old('subcategoria_id')==$sub->id ? 'selected' : '' }}>
                            {{ $sub->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('subcategoria_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Fecha inicio --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Fecha inicio</label>
                <input type="datetime-local" name="fecha_inicio"
                       class="form-control @error('fecha_inicio') is-invalid @enderror"
                       value="{{ old('fecha_inicio') }}" required>
                @error('fecha_inicio')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Fecha fin --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Fecha fin</label>
                <input type="datetime-local" name="fecha_fin"
                       class="form-control @error('fecha_fin') is-invalid @enderror"
                       value="{{ old('fecha_fin') }}" required>
                @error('fecha_fin')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Activo --}}
            <div class="col-md-6 mb-3">
                <label class="form-label d-block">Activo</label>
                <div class="form-check form-switch">
                    <input type="checkbox" name="activo" value="1" class="form-check-input" checked>
                </div>
                @error('activo')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-primary" type="submit">Guardar Promoción</button>
            </div>

        </div>
    </form>