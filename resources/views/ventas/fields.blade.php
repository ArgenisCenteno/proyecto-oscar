 
<div>
    

    {{-- Datos del usuario --}}
    <h4>Cliente</h4>
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" value="{{ $venta->user ? $venta->user->name : 'Invitado' }}" readonly>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Correo</label>
            <input type="text" class="form-control" value="{{ $venta->user ? $venta->user->email : '-' }}" readonly>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" value="{{ $venta->user ? $venta->user->telefono ?? '-' : '-' }}" readonly>
        </div>
    </div>

    {{-- Detalles de la venta --}}
    <h4>Detalles de la venta</h4>
    <table class="table table-bordered mb-2">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Variante</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalles as $detalle)
                @php
                    $variantes = $detalle->variantes ? json_decode($detalle->variantes, true) : null;
                    $imagen = $detalle->producto->imagenes->first();
                @endphp
                <tr>
                    <td>
                        @if($imagen)
                            <img src="{{ asset('storage/' . $imagen->imagen) }}" alt="{{ $detalle->producto->nombre }}" width="60">
                        @else
                            <span>No imagen</span>
                        @endif
                    </td>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>
                        @if($variantes)
                            Color: {{ $variantes['color'] ?? '-' }} <br>
                            Talla: {{ $variantes['talla'] ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio, 2) }}</td>
                    <td>${{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagos --}}
    <h4>Pagos</h4>
    <table class="table table-bordered mb-2">
        <thead>
            <tr>
                <th>Método</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Referencia</th>
                <th>Monto (USD)</th>
                <th>Monto (Bs)</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->pagos as $pago)
            <tr>
                <td>{{ $pago->metodo }}</td>
                <td>{{ $pago->origen }}</td>
                <td>{{ $pago->destino }}</td>
                <td>{{ $pago->referencia }}</td>
                <td>${{ number_format($pago->monto, 2) }}</td>
                <td>Bs {{ number_format($pago->monto_bs, 2) }}</td>
                <td>{{ $pago->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@can('edit ventas')
    {{-- Actualizar estado --}}
    <h4>Actualizar estado de la venta</h4>
    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select name="estado" id="estado" class="form-control" required>
        <option value="Pagado" {{ $venta->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
         <option value="Cancelado" {{ $venta->estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
        <option value="En Revisión" {{ $venta->estado == 'En Revisión' ? 'selected' : '' }}>En Revisión</option>
    </select>
</div>


            <div class="col-md-6 mb-3">
                <label for="entregado" class="form-label">Entregado</label>
                <select name="entregado" id="entregado" class="form-control" required>
                    <option value="1" {{ $venta->entregado ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ !$venta->entregado ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Actualizar Venta</button>
    </form>
    @endcan
</div> 