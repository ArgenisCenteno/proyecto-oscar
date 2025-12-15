<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">Contraseña (dejar en blanco si no quiere cambiarla)</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" name="cedula" id="cedula" class="form-control" value="{{ old('cedula', $user->cedula) }}">
            @error('cedula')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $user->telefono) }}">
            @error('telefono')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

       @hasanyrole('SUPERADMIN|EMPLEADO')

    <div class="col-md-6 mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select name="rol" id="rol" class="form-control" required>
            <option value="">Seleccione un rol</option>
            @foreach($roles as $rol)
                <option value="{{ $rol->name }}"
                    {{ $user->hasRole($rol->name) ? 'selected' : '' }}>
                    {{ $rol->name }}
                </option>
            @endforeach
        </select>
        @error('rol')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="bloqueado" class="form-label">Bloqueado</label>
        <select name="bloqueado" id="bloqueado" class="form-control">
            <option value="0" {{ !$user->bloqueado ? 'selected' : '' }}>No</option>
            <option value="1" {{ $user->bloqueado ? 'selected' : '' }}>Sí</option>
        </select>
    </div>

@else
    {{-- Mantener valores actuales sin permitir edición --}}
    <input type="hidden" name="rol" value="{{ $user->roles->first()->name ?? '' }}">
    <input type="hidden" name="bloqueado" value="{{ $user->bloqueado }}">
@endhasanyrole

    </div>

    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
</form>
