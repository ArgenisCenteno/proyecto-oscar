<form action="{{ route('permisos.update', $permiso->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nombre del Permiso</label>
        <input type="text" name="name" class="form-control" value="{{ $permiso->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Permiso</button>
</form>
