<form action="{{ route('subcategorias.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Nombre de la subcategoría</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control"
                rows="3">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="categoria_id" class="form-label">Categoría padre</label>
            <select name="categoria_id" id="categoria_id" class="form-control select2" required>
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*"
                onchange="previewImage(event)">
            @error('imagen')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Contenedor de la previsualización -->
        <div class="col-md-6 mb-3">
            <img id="preview" src="#" alt="Previsualización" class="img-fluid mt-2 d-none"
                style="max-height: 200px; border:1px solid #ddd; border-radius:8px; padding:5px;">
        </div>
    </div>


    <div class="d-flex justify-content-end">
        <a class="btn btn-danger me-2 " href="{{ route('categorias.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            preview.classList.add('d-none');
        }
    }
</script>