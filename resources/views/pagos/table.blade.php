<section id="ajax-datatable">
    <div class="card-datatable">
        <div class="datatables-ajax table table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Venta ID</th>
                         <th>Origen</th>
                          <th>Destino</th>
                           <th>Referencia</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('pagos.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'cliente', name: 'user.name' },
                { data: 'venta_id', name: 'venta.id' },
                { data: 'monto_formateado', name: 'monto' },
                   { data: 'origen', name: 'origen' },
                      { data: 'destino', name: 'destino' },
                         { data: 'referencia', name: 'referencia' },
                { data: 'estado', name: 'estado', orderable: true, searchable: true },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ],
            order: [[0, 'desc']],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros por Página",
                "zeroRecords": "Sin resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay Registros Disponibles",
                "infoFiltered": "Filtrado de _TOTAL_ de _MAX_ Registros Totales",
                "search": "Buscar",
                "paginate": {
                    "next": ">",
                    "previous": "<"
                }
            }
        });
    });
</script>
