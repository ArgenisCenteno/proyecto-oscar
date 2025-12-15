<section id="ajax-datatable">


    <div class="card-datatable">
        <div class="datatables-ajax table table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                         <th>Categoría</th>
                         <th>Subcategoría</th>
                        <th>Imagen</th>
                        <th>Categorías</th>
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
            ajax: "{{ route('productos.index') }}",
            dataType: 'json',
            type: "POST",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nombre', name: 'nombre' },
                { data: 'descripcion', name: 'descripcion' },
                 { data: 'categoria', name: 'categoria' },
                  { data: 'subcategoria', name: 'subcategoria' },
                { data: 'imagen', name: 'imagen' },
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