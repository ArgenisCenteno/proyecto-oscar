<form action="{{ route('permisos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nombre del Permiso</label>
        <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del permiso" required>
    </div>
    <button type="submit" class="btn btn-primary">Crear Permiso</button>
</form>
