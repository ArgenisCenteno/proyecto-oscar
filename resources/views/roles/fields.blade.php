<form action="{{ route('roles.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nombre del Rol</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="guard_name" class="form-label">Guard Name</label>
        <input type="text" name="guard_name" id="guard_name" class="form-control" value="web" readonly required>
    </div>

    <button type="submit" class="btn btn-primary w-100 mt-2">Crear Rol</button>
</form>
