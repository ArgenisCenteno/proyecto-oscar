<section id="ajax-datatable">


    <div class="card-datatable">
        <div class="datatables-ajax table table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Cliente</th>
                        <th>Subtotal</th>
                        <th>Descuento</th>
                        <th>Total</th>
                         <th>Estado</th>
                         <th>Entregado</th>
                           <th>Moneda</th>
                            <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('ventas.index') }}",
            dataType: 'json',
            type: "POST",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'tipo', name: 'tipo' },
                { data: 'user.name', name: 'user.name' },
                { data: 'subtotal', name: 'subtotal' },
                  { data: 'descuento', name: 'descuento' },
                   { data: 'total', name: 'total' },
                     { data: 'estado', name: 'estado' },
                    { data: 'entregado', name: 'entregado' },
                      { data: 'moneda', name: 'moneda' },
                { data: 'actions', name: 'actions' },
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