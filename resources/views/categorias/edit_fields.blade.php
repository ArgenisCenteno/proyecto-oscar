<form action="{{ route('categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Nombre de la categoría</label>
            <input type="text" name="nombre" id="nombre" class="form-control" 
                   value="{{ old('nombre', $categoria->nombre) }}" required>
            @error('nombre')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            @error('descripcion')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" onchange="previewImage(event)">
            @error('imagen')
                <span class="text-danger small">{{ $message }}</span>
            @enderror

          
        </div>
  @if($categoria->imagen)
                <div class="col-md-6 ">
                    <p class="small mb-1">Imagen actual:</p>
                    <img src="{{ asset('storage/'.$categoria->imagen) }}" alt="Imagen actual" class="img-fluid" style="max-height: 150px; border:1px solid #ddd; border-radius:8px; padding:5px;">
                </div>
            @endif
        <!-- Contenedor de la previsualización (cuando se selecciona nueva imagen) -->
        <div class="col-md-6 mb-3">
            <img id="preview" src="#" alt="Previsualización" class="img-fluid mt-2 d-none" style="max-height: 200px; border:1px solid #ddd; border-radius:8px; padding:5px;">
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a class="btn btn-danger me-2" href="{{ route('categorias.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
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
