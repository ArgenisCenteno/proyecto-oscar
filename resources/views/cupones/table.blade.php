<section id="ajax-datatable">


    <div class="card-datatable">
        <div class="datatables-ajax table table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Limite</th>
                        <th>Uso</th>
                        <th>Desde</th>
                        <th>Hasta</th>
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
            ajax: "{{ route('cupones.index') }}",
            dataType: 'json',
            type: "POST",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'codigo', name: 'codigo' },
                { data: 'tipo', name: 'tipo' },
                { data: 'valor', name: 'valor' },
                { data: 'max_uso', name: 'max_uso' },
                { data: 'usados', name: 'usados' },
                { data: 'fecha_inicio', name: 'fecha_inicio' },
                { data: 'fecha_fin', name: 'fecha_fin' },
                { data: 'estado', name: 'estado' },
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