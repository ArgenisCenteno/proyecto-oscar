<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nombre del Rol</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="guard_name" class="form-label">Guard Name</label>
        <input type="text" name="guard_name" id="guard_name" class="form-control" value="{{ old('guard_name', $role->guard_name) }}" required>
        @error('guard_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Permisos</label>
        <div class="form-check">
            @foreach($permisos as $permiso)
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permiso->name }}"
                    {{ in_array($permiso->name, $rolePermisos) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $permiso->name }}</label><br>
            @endforeach
            @error('permissions')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100 mt-2">Actualizar Rol</button>
</form>
