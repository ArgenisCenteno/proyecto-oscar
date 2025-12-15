 {{-- Datos del cliente --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Cliente</label>
            <input type="text" class="form-control" value="{{ $pago->user ? $pago->user->name : 'Invitado' }}" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" value="{{ $pago->user ? $pago->user->email : '-' }}" readonly>
        </div>
    </div>

    {{-- Datos del pago --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Venta ID</label>
            <input type="text" class="form-control" value="{{ $pago->venta_id }}" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label">Método de Pago</label>
            <input type="text" class="form-control" value="{{ ucfirst(str_replace('_', ' ', $pago->metodo)) }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Banco / Cuenta Origen</label>
            <input type="text" class="form-control" value="{{ $pago->origen }}" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label">Banco / Cuenta Destino</label>
            <input type="text" class="form-control" value="{{ $pago->destino }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Referencia / Número de pago</label>
            <input type="text" class="form-control" value="{{ $pago->referencia }}" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label">Fecha de pago</label>
            <input type="text" class="form-control" value="{{ $pago->fecha_pago }}" readonly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Monto (USD)</label>
            <input type="text" class="form-control" value="${{ number_format($pago->monto, 2) }}" readonly>
        </div>
        <div class="col-md-6">
            <label class="form-label">Monto en Bs</label>
            <input type="text" class="form-control" value="Bs {{ number_format($pago->monto_bs, 2) }}" readonly>
        </div>
    </div>

    {{-- Formulario para actualizar estado --}}
    <form action="{{ route('pagos.update', $pago->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="Pagado" {{ $pago->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                    <option value="No Pagado" {{ $pago->estado == 'No Pagado' ? 'selected' : '' }}>No Pagado</option>
                    <option value="Cancelado" {{ $pago->estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    <option value="En Revisión" {{ $pago->estado == 'En Revisión' ? 'selected' : '' }}>En Revisión</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Pago</button>
    </form>