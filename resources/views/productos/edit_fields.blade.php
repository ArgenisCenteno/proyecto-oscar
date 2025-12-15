<form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- ERRORES GENERALES --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Hay errores en el formulario:</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row">

        {{-- SUBCATEGORÍA --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Subcategoría</label>
            <select name="subcategoria_id"
                class="form-control @error('subcategoria_id') is-invalid @enderror"
                required>
                <option value="">Seleccione...</option>
                @foreach ($subcategorias as $s)
                    <option value="{{ $s->id }}" {{ $producto->subcategoria_id == $s->id ? 'selected' : '' }}>
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
            <label class="form-label">SKU</label>
            <input type="text"
                name="sku"
                value="{{ old('sku', $producto->sku) }}"
                class="form-control @error('sku') is-invalid @enderror">
            @error('sku')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- NOMBRE --}}
        <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text"
                name="nombre"
                value="{{ old('nombre', $producto->nombre) }}"
                class="form-control @error('nombre') is-invalid @enderror" required>
            @error('nombre')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- PRECIO --}}
        <div class="col-md-3 mb-3">
            <label class="form-label">Precio</label>
            <input type="number"
                name="precio"
                value="{{ old('precio', $producto->precio) }}"
                class="form-control moneda @error('precio') is-invalid @enderror"
                min="0" step="0.01" required>
            @error('precio')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- STOCK --}}
        <div class="col-md-3 mb-3">
            <label class="form-label">Stock</label>
            <input type="number"
                name="stock"
                value="{{ old('stock', $producto->stock) }}"
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
                class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $producto->descripcion) }}</textarea>

            @error('descripcion')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- IMÁGENES EXISTENTES --}}
        <div class="col-12 mb-4">
            <label class="form-label">Imágenes actuales</label>
            <div class="d-flex flex-wrap gap-2 mb-2">

                @foreach ($producto->imagenes as $img)
                    <div class="text-center" style="width: 90px;">
                        <img src="{{ asset('storage/' . $img->imagen) }}"
                            style="width: 90px; height: 90px; object-fit: cover; border-radius: 6px;">
                        <br>
                        <input type="checkbox" name="eliminar_imagenes[]" value="{{ $img->id }}">
                        <small>Eliminar</small>
                    </div>
                @endforeach

            </div>

            {{-- NUEVAS IMÁGENES --}}
            <label class="form-label mt-2">Agregar nuevas imágenes</label>
            <input type="file"
                name="imagenes[]"
                multiple
                accept="image/*"
                id="input-imagenes"
                class="form-control @error('imagenes.*') is-invalid @enderror">

            @error('imagenes.*')
                <small class="invalid-feedback d-block">{{ $message }}</small>
            @enderror

            <div id="preview-imagenes" class="mt-3 d-flex flex-wrap gap-2"></div>
        </div>

        {{-- VARIANTES --}}
        <div class="col-12">
            <label class="form-label">Variantes</label>

            <div id="contenedor-variantes">

                {{-- EXISTENTES --}}
                @foreach ($producto->variantes as $index => $v)

                    <div class="variante-item border p-3 rounded mb-3 bg-light">

                        <input type="hidden" name="variantes_existentes[{{ $index }}][id]" value="{{ $v->id }}">

                        <div class="row">

                            {{-- TALLA --}}
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Talla</label>
                                <select name="variantes_existentes[{{ $index }}][talla]"
                                    class="form-control @error("variantes_existentes.$index.talla") is-invalid @enderror">

                                    @foreach (['XS','S','M','L','XL','XXL','XXXL'] as $t)
                                        <option value="{{ $t }}" {{ $v->talla == $t ? 'selected' : '' }}>
                                            {{ $t }}
                                        </option>
                                    @endforeach

                                </select>
                                @error("variantes_existentes.$index.talla")
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- COLOR --}}
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Color</label>
                                <input type="text"
                                    name="variantes_existentes[{{ $index }}][color]"
                                    value="{{ $v->color }}"
                                    class="form-control only-text @error("variantes_existentes.$index.color") is-invalid @enderror">
                                @error("variantes_existentes.$index.color")
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- PRECIO --}}
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Precio</label>
                                <input type="number"
                                    name="variantes_existentes[{{ $index }}][precio]"
                                    min="0" step="0.01"
                                    value="{{ $v->precio }}"
                                    class="form-control moneda @error("variantes_existentes.$index.precio") is-invalid @enderror">
                                @error("variantes_existentes.$index.precio")
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- STOCK --}}
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Stock</label>
                                <input type="number"
                                    name="variantes_existentes[{{ $index }}][stock]"
                                    min="0"
                                    value="{{ $v->stock }}"
                                    class="form-control moneda @error("variantes_existentes.$index.stock") is-invalid @enderror">
                                @error("variantes_existentes.$index.stock")
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <label>
                            <input type="checkbox" name="eliminar_variantes[]" value="{{ $v->id }}">
                            Eliminar variante
                        </label>

                    </div>

                @endforeach

            </div>

            <button type="button" class="btn btn-outline-primary mt-3" id="btn-agregar-variante">
                + Agregar variante
            </button>
        </div>

    </div>

    <div class="mt-4">
        <button class="btn btn-success">Actualizar Producto</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>

</form>

<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    // --- PREVISUALIZACIÓN DE NUEVAS IMÁGENES ---
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
$("#btn-agregar-variante").click(function () {
    let index = $(".variante-item").length;

    $("#contenedor-variantes").append(`
        <div class="variante-item border p-3 rounded mb-3 bg-light">

            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label">Talla</label>
                    <select name="variantes_nuevas[${index}][talla]" class="form-control">
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
                    <input type="text" name="variantes_nuevas[${index}][color]" class="form-control only-text">
                </div>

                <div class="col-md-3 mb-2">
                    <label class="form-label">Precio</label>
                    <input type="number" name="variantes_nuevas[${index}][precio]"
                           class="form-control moneda" min="0" step="0.01">
                </div>

                <div class="col-md-3 mb-2">
                    <label class="form-label">Stock</label>
                    <input type="number" name="variantes_nuevas[${index}][stock]"
                           class="form-control moneda" min="0">
                </div>
            </div>

            <button type="button" class="btn btn-danger btn-sm mt-2 btn-eliminar-variante">
                Eliminar variante
            </button>
        </div>
    `);
});

// Eliminar variante nueva antes de guardar
$(document).on("click", ".btn-eliminar-variante", function () {
    $(this).closest(".variante-item").remove();
});

</script>