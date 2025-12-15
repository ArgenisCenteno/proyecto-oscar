<td>
    <div class="d-flex gap-1">
        @if(Auth::user()->hasRole('SUPERADMIN'))
         <a href="{{ route('impersonate', $id) }}" class="btn btn-dark btn-sm" data-bs-toggle="tooltip"
            data-bs-placement="top" title="Impersonar usuario">
            <i class="bi bi-person-fill-lock text-white"></i>
        </a>
        @endif
        <!-- Botón Editar -->
        <a href="{{ route('users.edit', $id) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip"
            data-bs-placement="top" title="Editar">
            <i class="bi bi-pencil-square text-white"></i>
        </a>
@can('delete users')
        <!-- Botón Eliminar -->
        <form action="{{ route('users.destroy', $id) }}" method="POST" class="btn-delete" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Eliminar">
                <i class="bi bi-trash text-white"></i>
            </button>
        </form>
        @endcan
    </div>
</td>

<!-- SweetAlert2 -->
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.btn-delete').submit(function (e) {
            e.preventDefault();
            const form = this;

            Swal.fire({
                title: '¿Está seguro?',
                text: "El registro se eliminará permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0dac55',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
