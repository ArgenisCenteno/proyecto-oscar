 <form action="{{ route('cupones.store') }}" method="POST">
        @csrf

        <div class="row">

            {{-- Código --}}
            <div class="col-md-6 mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror"
                       value="{{ old('codigo') }}" required>
                @error('codigo')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tipo --}}
            <div class="col-md-6 mb-3">
                <label for="tipo" class="form-label">Tipo de Descuento</label>
                <select name="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                    <option value="">Seleccione</option>
                    <option value="porcentaje" {{ old('tipo') == 'porcentaje' ? 'selected' : '' }}>Porcentaje (%)</option>
                    <option value="fijo" {{ old('tipo') == 'fijo' ? 'selected' : '' }}>Monto Fijo</option>
                </select>
                @error('tipo')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Valor --}}
            <div class="col-md-6 mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" step="0.01" name="valor"
                       class="form-control @error('valor') is-invalid @enderror"
                       value="{{ old('valor') }}" required>
                @error('valor')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Mínimo --}}
            <div class="col-md-6 mb-3">
                <label for="minimo" class="form-label">Compra mínima</label>
                <input type="number" step="0.01" name="minimo"
                       class="form-control @error('minimo') is-invalid @enderror"
                       value="{{ old('minimo') }}">
                @error('minimo')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Máx usos --}}
            <div class="col-md-6 mb-3">
                <label for="max_uso" class="form-label">Máximo de usos</label>
                <input type="number" name="max_uso"
                       class="form-control @error('max_uso') is-invalid @enderror"
                       value="{{ old('max_uso', 1) }}" required>
                @error('max_uso')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Fecha inicio --}}
            <div class="col-md-6 mb-3">
                <label for="fecha_inicio" class="form-label">Fecha inicio</label>
                <input type="datetime-local" name="fecha_inicio"
                       class="form-control @error('fecha_inicio') is-invalid @enderror"
                       value="{{ old('fecha_inicio') }}" required>
                @error('fecha_inicio')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Fecha fin --}}
            <div class="col-md-6 mb-3">
                <label for="fecha_fin" class="form-label">Fecha fin</label>
                <input type="datetime-local" name="fecha_fin"
                       class="form-control @error('fecha_fin') is-invalid @enderror"
                       value="{{ old('fecha_fin') }}" required>
                @error('fecha_fin')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Activo --}}
            <div class="col-md-6 mb-3">
                <label class="form-label d-block">Estado</label>
                <div class="form-check form-switch">
                    <input class="form-check-input @error('activo') is-invalid @enderror"
                           type="checkbox" name="activo" value="1"
                           {{ old('activo', true) ? 'checked' : '' }}>
                </div>
                @error('activo')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-primary" type="submit">Guardar Cupón</button>
            </div>

        </div>
    </form>