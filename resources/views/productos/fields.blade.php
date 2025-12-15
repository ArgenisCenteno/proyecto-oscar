<form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- ERRORES GENERALES --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Hay errores en el formulario:</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row">

        {{-- SUBCATEGORÍA --}}
        <div class="col-md-6 mb-3">
            <label for="subcategoria_id" class="form-label">Subcategoría</label>
            <select name="subcategoria_id"
                class="form-control @error('subcategoria_id') is-invalid @enderror" required>
                <option value="">Seleccione...</option>
                @foreach ($subcategorias as $s)
                    <option value="{{ $s->id }}" {{ old('subcategoria_id') == $s->id ? 'selected' : '' }}>
                        {{ $s->nombre }}
                    </option>
                @endforeach
            </select>

            @error('subcategoria_id')
                <small class="invalid-feedback d-block">{{ $message }}</small>
            @enderror
        </div>

        {{-- SKU --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">SKU (opcional)</label>
            <input type="text" name="sku"
                value="{{ old('sku') }}"
                class="form-control @error('sku') is-invalid @enderror"
                placeholder="SKU del producto">

            @error('sku')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- NOMBRE --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre"
                value="{{ old('nombre') }}"
                class="form-control @error('nombre') is-invalid @enderror" required>

            @error('nombre')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- PRECIO --}}
        <div class="col-md-3 mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio"
                value="{{ old('precio') }}"
                class="form-control moneda @error('precio') is-invalid @enderror"
                min="0" step="0.01" required>

            @error('precio')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- STOCK GENERAL --}}
        <div class="col-md-3 mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock"
                value="{{ old('stock') }}"
                class="form-control moneda @error('stock') is-invalid @enderror"
                min="0" required>

            @error('stock')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- DESCRIPCIÓN --}}
        <div class="col-12 mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" rows="3"
                class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>

            @error('descripcion')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- IMÁGENES --}}
        <div class="col-12 mb-4">
            <label class="form-label">Imágenes (puedes subir varias)</label>
            <input type="file" name="imagenes[]" multiple accept="image/*"
                class="form-control @error('imagenes.*') is-invalid @enderror"
                id="input-imagenes">

            @error('imagenes.*')
                <small class="invalid-feedback d-block">{{ $message }}</small>
            @enderror

            <div id="preview-imagenes" class="mt-3 d-flex flex-wrap gap-2"></div>
        </div>

        {{-- VARIANTES --}}
        <div class="col-12">
            <label class="form-label">Variantes (opcional)</label>

            <div id="contenedor-variantes"></div>

            <button type="button" class="btn btn-outline-primary mt-3" id="btn-agregar-variante">
                + Agregar variante
            </button>
        </div>

    </div>

    <div class="mt-4">
        <button class="btn btn-success">Guardar Producto</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>

</form>

<!-- jQuery -->
<script src="{{ asset('js/jquery.js') }}"></script>


{{-- ========================= --}}
{{-- PREVISUALIZACIÓN DE IMÁGENES --}}
{{-- ========================= --}}
<script>
    $("#input-imagenes").on("change", function (event) {
        let files = event.target.files;
        let preview = $("#preview-imagenes");
        preview.empty();

        Array.from(files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function (e) {
                preview.append(`
                <img src="${e.target.result}" 
                     class="rounded" 
                     style="width: 90px; height: 90px; object-fit: cover; border: 1px solid #ddd;">
            `);
            }
            reader.readAsDataURL(file);
        });
    });
</script>

{{-- ========================= --}}
{{-- VARIANTES DINÁMICAS --}}
{{-- ========================= --}}
<script>
    $("#btn-agregar-variante").click(function () {
        let index = $(".variante-item").length;

        $("#contenedor-variantes").append(`
        <div class="variante-item border p-3 rounded mb-3 bg-light">

            <div class="row">
                <div class="col-md-3 mb-2">
    <label class="form-label">Talla</label>
    <select name="variantes[${index}][talla]" class="form-control">
        <option value="">Seleccione</option>
        <option value="XS">XS</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXL">XXL</option>
        <option value="XXXL">XXXL</option>
    </select>
</div>


                <div class="col-md-3 mb-2">
                    <label class="form-label">Color</label>
                    <input type="text" name="variantes[${index}][color]" class="form-control only-text">
                </div>

                <div class="col-md-3 mb-2">
                    <label class="form-label">Precio</label>
                    <input type="number" name="variantes[${index}][precio]" class="form-control moneda" min="0" step="0.01">
                </div>

                <div class="col-md-3 mb-2">
                    <label class="form-label">Stock</label>
                    <input type="number" name="variantes[${index}][stock]" class="form-control moneda" min="0">
                </div>
            </div>

            <button type="button" class="btn btn-danger btn-sm mt-2 btn-eliminar-variante">
                Eliminar variante
            </button>
        </div>
    `);
    });

    // Eliminar variante
    $(document).on("click", ".btn-eliminar-variante", function () {
        $(this).closest(".variante-item").remove();
    });
</script>