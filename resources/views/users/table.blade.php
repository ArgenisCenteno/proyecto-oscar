<section id="ajax-datatable">


    <div class="card-datatable">
        <div class="datatables-ajax table table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                         <th>Email</th>
                          <th>Cédula</th>
                           <th>Telefono</th>
                           <th>Último Login</th>
                           <th>Conectado</th>
                            <th>Bloqueado</th>
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
            ajax: "{{ route('users.index') }}",
            dataType: 'json',
            type: "POST",
            columns: [
                { data: 'id', name: 'id' },
                 { data: 'name', name: 'name' },
                  { data: 'email', name: 'email' },
                   { data: 'cedula', name: 'cedula' },
                    { data: 'telefono', name: 'telefono' },
                     { data: 'ultimo_login', name: 'ultimo_login' },
                      { data: 'conectado', name: 'conectado' },
                       { data: 'bloqueado', name: 'bloqueado' },
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